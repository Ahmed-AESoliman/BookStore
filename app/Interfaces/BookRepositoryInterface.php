<?php

namespace App\Interfaces;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface BookRepositoryInterface extends BaseRepositoryInterface
{
    public function uploadAttachments(Request $request): JsonResponse;
    public function deleteAttachment(string $path): JsonResponse;
}
