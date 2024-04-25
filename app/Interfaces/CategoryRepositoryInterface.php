<?php

namespace App\Interfaces;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface CategoryRepositoryInterface
{
    public function generalCategories(Request $request): JsonResponse;
    public function educationalCategories(Request $request): JsonResponse;
    public function educationalSubCategories(Request $request): JsonResponse;
    // public function educationalSubjects(Request $request): JsonResponse;
}