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

    public function index(): View
    {
        $products = $this->repository->getPaginationProducts(6);
        $categories = Categorie::withCount('products')->orderBy('name')->get();
        $totalProducts = Product::count();

        return view('web.products', compact('products', 'categories', 'totalProducts'));
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
        $products = $this->repository->getEightWithPhoto();

        $products = array_slice($products->toArray(), 0, 8);

        return response()->json($products);
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
            'pagination' => (string) $products->links('vendor.pagination.bootstrap-5'),
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

        $filesByField = $product->files()->get()->keyBy('field_name');
        $photosBySize = [];
        if ($product->sizes->isNotEmpty()) {
            foreach ($product->sizes as $s => $size) {
                $photos = [];
                for ($p = 1; $p <= 6; $p++) {
                    $field = 'photo' . ($s * 6 + $p);
                    $file = $filesByField->get($field);
                    if ($file && $file->file_url) {
                        $photos[] = ['url' => $file->file_url];
                    }
                }
                $photosBySize[] = $photos;
            }
        } else {
            $photos = [];
            foreach (['photo1', 'photo2', 'photo3', 'photo4'] as $field) {
                $file = $filesByField->get($field);
                if ($file && $file->file_url) {
                    $photos[] = ['url' => $file->file_url];
                }
            }
            $photosBySize[] = $photos;
        }

        return view('web.single-product', [
            'product' => $product,
            'featuredProducts' => $featuredProducts,
            'photosBySize' => $photosBySize,
        ]);
    }
}
