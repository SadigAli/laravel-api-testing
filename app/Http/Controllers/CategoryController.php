<?php

namespace App\Http\Controllers;

use App\Helpers\SlugGenerator;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        public CategoryService $categoryService,
        public SlugGenerator $slugGenerator,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = $this->categoryService->pagination($request->get('limit', 10), $request->get('page', 1));

        if (count($categories) == 0) {
            return response([
                'status' => 'error',
                'message' => 'Data not found',
            ]);
        }

        return response([
            'status' => 'success',
            'message' => 'Data has fetched successfully',
            'data' => CategoryResource::collection($categories),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $langs = config('app.languages');
        foreach ($langs as $lang) {
            $data['slug_' . $lang] = $this->slugGenerator->generate_slug($data['name_' . $lang]);
        }
        $response = $this->categoryService->create($data);
        return response($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = $this->categoryService->getById($id);
        return response([
            'status' => 'success',
            'data' => new CategoryResource($category),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $data = $request->validated();
        $category = $this->categoryService->getById($id);
        $langs = config('app.languages');
        foreach ($langs as $lang) {
            $data['slug_' . $lang] = $this->slugGenerator->generate_slug($data['name_' . $lang]);
        }
        $response = $this->categoryService->edit($category, $data);
        return response($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = $this->categoryService->getById($id);
        $response = $this->categoryService->delete($category);
        return response($response);
    }
}
