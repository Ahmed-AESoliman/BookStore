<?php

namespace App\Interfaces;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface BaseRepositoryInterface
{
    /**
     * Retrieve all models
     * @param Request $request
     */
    public function index(Request $request);
    /**
     * Create new model
     * @param array $data
     * @return JsonResponse
     */
    public function store(array $data);

    /**
     * Show Model By ID
     * @param Model $model
     * @return JsonResponse
     */
    public function show(Model $model): JsonResponse;

    /**
     * @param array $data
     * @param Model $model
     * @return JsonResponse
     */
    public function update(array $data, Model $model): JsonResponse;

    /**
     * @param Model $model
     * @return JsonResponse
     */
    public function delete(Model $model): JsonResponse;

    /**
     * @param Model $model
     * @return bool
     */
    public function restore(Model $model): bool;

    /**
     * @param Model $model
     * @return bool
     */
    public function forceDelete(Model $model): bool;
}
