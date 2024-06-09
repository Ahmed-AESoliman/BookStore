<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepositoryInterface
     */
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function generalCategories(Request $request): JsonResponse
    {
        return $this->categoryRepository->generalCategories($request);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function educationalCategories(Request $request): JsonResponse
    {
        return $this->categoryRepository->educationalCategories($request);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    // public function educationalSubCategories(Request $request): JsonResponse
    // {
    //     $request->validate(['category_id' => 'required|exists:categories,id']);
    //     return $this->categoryRepository->educationalSubCategories($request);
    // }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    // public function educationalSubjects(Request $request): JsonResponse
    // {
    //     $request->validate(['sub_category_id' => 'required|exists:sub_categories,id']);

    //     return $this->categoryRepository->educationalSubjects($request);
    // }
}
