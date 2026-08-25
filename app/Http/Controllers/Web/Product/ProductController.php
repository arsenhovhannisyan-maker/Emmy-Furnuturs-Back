<?php

namespace App\Http\Controllers\Web\Product;

use App\Contracts\Product\IProductRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShopProductsBrowseRequest;
use App\Models\Categorie\Categorie;
use App\Models\Product\Product;
use App\Services\Product\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(
        ProductService $service,
        IProductRepository $repository,
    ) {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function index(Request $request): View
    {
        $categories = Categorie::withCount('products')->orderBy('name')->get();
        $totalProducts = Product::count();
        $dbMaxPrice = (int) ceil((float) (Product::query()->max('price') ?? 0));
        $priceMax = max(50000, $dbMaxPrice);

        $requestedCategoryId = (int) $request->query('categoryId', 0);
        $selectedCategoryId = ($requestedCategoryId > 0 && $categories->contains('id', $requestedCategoryId))
            ? $requestedCategoryId
            : null;

        $products = $selectedCategoryId
            ? $this->repository->browseForShop(0, $priceMax, [$selectedCategoryId], 6)
            : $this->repository->getPaginationProducts(6);

        return view('web.products', compact('products', 'categories', 'totalProducts', 'priceMax', 'selectedCategoryId'));
    }

    public function getProductForCategories($categoryId): View
    {
        $categoryId = (int) $categoryId;

        $products = $this->repository->getTargetProducts($categoryId);

        return view('web.products', [
            'products' => $products,
        ]);
    }

    public function getEightProducts(): JsonResponse
    {
        return response()->json($this->repository->getEightWithPhoto());
    }

    public function quickBuyCategories(): JsonResponse
    {
        $categories = Categorie::query()
            ->withCount('products')
            ->having('products_count', '>', 0)
            ->orderBy('name')
            ->get(['id', 'name'])
            ->map(fn (Categorie $categorie) => [
                'id' => $categorie->id,
                'name' => $categorie->name,
                'products_count' => $categorie->products_count,
            ]);

        return response()->json($categories);
    }

    public function quickBuyProducts($categoryId): JsonResponse
    {
        $categorie = Categorie::select('id', 'name')->findOrFail((int) $categoryId);

        $products = Product::query()
            ->where('category_id', $categorie->id)
            ->with(['photo1', 'sizes'])
            ->orderBy('name')
            ->get()
            ->map(function (Product $product) {
                $sizes = $product->sizes->sortBy('id')->values();
                $hasSizes = $sizes->isNotEmpty();

                // The price actually charged at checkout is always the raw `price` column
                // (see BasketItem::getUnitPriceAttribute) - discount is only ever used to
                // reconstruct a higher "was" price for display (Product::getOldPriceAttribute),
                // never subtracted from the charged price.
                $chargedPrice = (float) $product->price;
                $oldPrice = $product->old_price;

                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'url' => route('web.product', $product->id),
                    'image' => $product->photo1?->file_url,
                    'has_sizes' => $hasSizes,
                    'sizes' => $sizes->map(fn ($size) => [
                        'id' => $size->id,
                        'label' => $size->size,
                        'formatted_price' => number_format((float) $size->price, 0, '', ' '),
                    ])->values(),
                    'price' => $hasSizes ? null : number_format($chargedPrice, 0, '', ' '),
                    'old_price' => (!$hasSizes && $oldPrice !== null) ? number_format($oldPrice, 0, '', ' ') : null,
                    'min_price' => $hasSizes ? number_format($sizes->min('price'), 0, '', ' ') : null,
                ];
            });

        return response()->json([
            'category' => ['id' => $categorie->id, 'name' => $categorie->name],
            'products' => $products,
        ]);
    }

    public function browse(ShopProductsBrowseRequest $request): JsonResponse
    {
        $min = (float) $request->validated('min_price');
        $max = (float) $request->validated('max_price');
        $categoryIds = $request->validated('category_ids') ?? [];
        $perPage = (int) ($request->validated('per_page') ?? 6);

        $products = $this->repository->browseForShop($min, $max, $categoryIds, $perPage);

        return response()->json([
            'products' => $products->items(),
            'pagination' => (string) $products->links('vendor.pagination.shop-products'),
            'total' => $products->total(),
            'from' => $products->firstItem(),
            'to' => $products->lastItem(),
        ]);
    }

    public function search(Request $request): JsonResponse
    {
        $query = $request->input('s');

        if (!$query) {
            return response()->json([]);
        }

        $products = Product::where('name', 'like', "%{$query}%")
            ->with('photo1') // Eager load the relationship
            ->take(5)
            ->get();

        // Transform the products to include only the data we need
        $formattedProducts = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->photo1 ? $product->photo1->file_url : null
            ];
        });

        return response()->json($formattedProducts);
    }

    public function getProduct(int $id): View
    {
        $product = $this->repository->find($id, ['sizes']);
        $featuredProducts = $this->repository->getFeaturedProducts($id);

        $product->setRelation('sizes', $product->sizes->sortBy('id')->values());

        if ($product->sizes->isNotEmpty()) {
            $minPrice = $product->sizes->min('price');
            $maxPrice = $product->sizes->max('price');
            $product->min_price = number_format($minPrice, 0, '', ' ');
            $product->max_price = number_format($maxPrice, 0, '', ' ');
            $product->sizes->each(function ($size) {
                $size->formatted_price = number_format($size->price, 0, '', ' ');
            });
        }

        $filesBySize = $product->photos()->get()->groupBy('product_size_id');
        $photosBySize = [];
        if ($product->sizes->isNotEmpty()) {
            foreach ($product->sizes as $size) {
                $photosBySize[] = ($filesBySize->get($size->id) ?? collect())
                    ->map(fn ($file) => ['url' => $file->file_url])
                    ->values()
                    ->toArray();
            }
        } else {
            $photosBySize[] = ($filesBySize->get(null) ?? collect())
                ->map(fn ($file) => ['url' => $file->file_url])
                ->values()
                ->toArray();
        }

        return view('web.single-product', [
            'product' => $product,
            'featuredProducts' => $featuredProducts,
            'photosBySize' => $photosBySize,
        ]);
    }
}
