<?php

namespace App\Http\Controllers\Web\Product;

use App\Contracts\Product\IProductRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFilterRequest;
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

    public function filter(ProductFilterRequest $request): JsonResponse
    {
        $min = $request->validated('min_price') ?? 0;
        $max = $request->validated('max_price') ?? 999999;

        $categories = $request->validated('categories');
        if ($categories && is_string($categories)) {
            $categories = array_map('intval', array_filter(explode(',', $categories)));
        }
        if (!is_array($categories)) {
            $categories = [];
        }

        $products = Product::whereBetween('price', [$min, $max])
            ->when(!empty($categories), function ($query) use ($categories) {
                $query->whereIn('category_id', $categories);
            })
            ->with('photo1')
            ->orderByDesc('created_at')
            ->paginate(6);

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
}
