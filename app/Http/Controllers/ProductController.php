<?php

namespace App\Http\Controllers;

use App\Helpers\FileUpload;
use App\Helpers\SlugGenerator;
use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\EditRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        public ProductService $productService,
        public SlugGenerator $slugGenerator,
        public FileUpload $fileUpload
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = $this->productService->pagination($request->get('limit', 10), $request->get('page', 1));
        if (count($products) == 0) {
            return response([
                'status' => 'error',
                'message' => 'Data not found',
            ]);
        }
        return response([
            'status' => 'success',
            'data' => ProductResource::collection($products),
            'message' => 'Data fetched successfully',
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) $data['image'] = $this->fileUpload->file_upload($request->file('image'), 'products');
        $langs = config('app.languages');
        foreach ($langs as $lang) {
            $data['slug_' . $lang] = $this->slugGenerator->generate_slug($data['title_' . $lang]);
        }

        $response = $this->productService->create($data);
        return response($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->productService->getById($id);
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditRequest $request, string $id)
    {
        $data = $request->validated();
        $product = $this->productService->getById($id);
        if ($request->hasFile('image')) {
            $this->fileUpload->file_delete($product->image);
            $data['image'] = $this->fileUpload->file_upload($request->file('image'), 'products');
        }
        $langs = config('app.languages');
        foreach ($langs as $lang) {
            $data['slug_' . $lang] = $data['title_' . $lang];
        }
        $response = $this->productService->edit($product,$data);
        return response($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = $this->productService->getById($id);
        $this->fileUpload->file_delete($product->image);
        $response = $this->productService->delete($product);
        return response($response);
    }
}
