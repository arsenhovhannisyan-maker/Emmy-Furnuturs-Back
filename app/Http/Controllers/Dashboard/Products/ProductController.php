<?php

namespace App\Http\Controllers\Dashboard\Products;

use App\Contracts\Product\IProductRepository;
use App\Http\Controllers\Dashboard\BaseController;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\ProductSearchRequest;
use App\Models\Categorie\Categorie;
use App\Models\Product\Product;
use App\Models\Product\ProductSearch;
use App\Services\Product\ProductPhotoService;
use App\Services\Product\ProductService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class ProductController extends BaseController
{
    public function __construct(
        ProductService $service,
        IProductRepository $repository,
        private readonly ProductPhotoService $photoService,
    ) {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function index(): View
    {
        return $this->dashboardView('product.index');
    }

    public function getListData(ProductSearchRequest $request): array
    {
        $searcher = new ProductSearch($request->validated());

        return [
            'recordsTotal' => $searcher->totalCount(),
            'recordsFiltered' => $searcher->filteredCount(),
            'data' => $searcher->search(),
        ];
    }

    public function create(): View
    {
        $viewData = $this->service->getViewData();
        $viewData['categories'] = Categorie::pluck('name', 'id')->toArray();

        return $this->dashboardView(
            view: 'product.form',
            vars: $viewData
        );
    }

    public function store(ProductRequest $request): JsonResponse
    {
        $this->service->createOrUpdate($request->validated());

        return $this->sendOkCreated([
            'redirectUrl' => route('dashboard.products.index')
        ]);
    }

    // public function show(Product $product): View
    // {
    /* return $this->dashboardView(
        view: 'product.form',
        vars: $this->service->getViewData($product->id),
        viewMode: 'show'
    );*/
    // }

    //    public function edit(Product $product): View
    //    {
    //        $product = $this->repository->find($product->id);
    //        $targetCategorie = $product->categories;
    //        return $this->dashboardView(
    //            view: 'product.form',
    //            vars: $this->service->getViewData($product->id),
    //            viewMode: 'edit'
    //        );
    //    }
    public function edit(Product $product): View
    {
        $product = $this->repository->find($product->id);
        $viewData = $this->service->getViewData($product->id);
        $viewData['categories'] = Categorie::pluck('name', 'id')->toArray();

        return $this->dashboardView(
            view: 'product.form',
            vars: $viewData,
            viewMode: 'edit'
        );
    }

    public function update(ProductRequest $request, Product $product): JsonResponse
    {
        $data = $request->validated();
        if (empty($data['category_id'])) {
            $existingProduct = Product::find($product->id);
            if ($existingProduct && $existingProduct->category_id) {
                $data['category_id'] = $existingProduct->category_id;
            } else {
                $defaultCategory = Categorie::where('name', 'Без категории')->first();
                if (!$defaultCategory) {
                    $defaultCategory = Categorie::create([
                        'name' => 'Без категории',
                        'slug' => Str::slug('Без категории')
                    ]);
                }
                $data['category_id'] = $defaultCategory->id;
            }
        }
        $this->service->createOrUpdate($data, $product->id);

        return $this->sendOkUpdated([
            'redirectUrl' => route('dashboard.products.index')
        ]);
    }

    public function destroy(Product $product): JsonResponse
    {
        $this->photoService->deleteAllPhotos($product);
        $this->repository->destroy($product->id);

        return $this->sendOkDeleted();
    }

    public function getProduct(int $id): \Illuminate\View\View
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
