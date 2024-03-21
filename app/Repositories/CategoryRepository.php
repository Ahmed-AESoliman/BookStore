<?php

namespace App\Repositories;

use App\Http\Responses\ApiResponse;
use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function generalCategories(Request $request): JsonResponse
    {
        $categories = Category::select('name', 'id')->where('is_educational', false)->get();
        return ApiResponse::success($categories);
    }

    public function educationalCategories(Request $request): JsonResponse
    {
        $categories = Category::select('name', 'id')->where('is_educational', true)->get();
        return ApiResponse::success($categories);
    }

    public function educationalSubCategories(Request $request): JsonResponse
    {
        $categories = SubCategory::select('name', 'id')->where('category_id', $request->category_id)->get();
        return ApiResponse::success($categories);
    }

    public function educationalSubjects(Request $request): JsonResponse
    {
        $subjects = Subject::select('name', 'id')->where('sub_category_id', $request->sub_category_id)->get();
        return ApiResponse::success($subjects);
    }
}
