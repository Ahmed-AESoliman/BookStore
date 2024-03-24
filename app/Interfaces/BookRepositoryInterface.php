<?php

namespace App\Interfaces;

use App\Http\Resources\BookCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface BookRepositoryInterface extends BaseRepositoryInterface
{
    public function uploadAttachments(Request $request): JsonResponse;
    public function deleteAttachment(string $path): JsonResponse;
    public function getBooksToAuthUser(Request $request): BookCollection;
}
