<?php

namespace App\Repositories;

use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Http\Resources\SingleBookResource;
use App\Http\Responses\ApiResponse;
use App\Interfaces\BookRepositoryInterface;
use App\Models\Attachment;
use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class BookRepository implements BookRepositoryInterface
{
    private Book $model;
    public function __construct(Book $model)
    {
        $this->model = $model;
    }

    public function index(Request $request): BookCollection
    {
        return new BookCollection($this->model->filter($request)->where('owner_id', '!=', auth()->user()->id)->paginate($request->input('page_size')));
    }

    public function store(array $data): JsonResponse
    {
        try {
            $data['owner_id'] = auth()->user()->id;
            $book = $this->model->create($data);
            if (isset($data['attachments'])) {
                foreach ($data['attachments'] as $attachment) {
                    $book->attachments()->create(['file_path' => $attachment]);
                }
            }
            return ApiResponse::success(null, 'success created', 201);
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage());
        }
    }

    public function update(array $data, Model $model): JsonResponse
    {
        try {
            $model->update($data);
            return ApiResponse::success(null, 'success updated', 200);
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage());
        }
    }

    public function show(Model $model): JsonResponse
    {
        return ApiResponse::success(new SingleBookResource($model));
    }

    public function delete(Model $model): JsonResponse
    {
        if ($model->owner_id == auth()->user()->id) {
            $model->delete();
            return ApiResponse::success(null, 'success deleted');
        }
        return ApiResponse::error('not Found Book');
    }

    public function restore(Model $model): bool
    {
        // TODO: Implement forceDelete() method.
        return false;
    }

    public function forceDelete(Model $model): bool
    {
        // TODO: Implement forceDelete() method.
        return false;
    }

    public function uploadAttachments(Request $request): JsonResponse
    {
        $path = $request->file('image')->store('books');
        return ApiResponse::success($path, null, 201);
    }

    public function deleteAttachment(string $path): JsonResponse
    {
        if (Storage::delete($path)) {
            Attachment::where('file_path', $path)->first()?->delete();
            return ApiResponse::success(null, 'success deleted');
        }
        return ApiResponse::error('somthing wrong try again');
    }

    public function getBooksToAuthUser(Request $request): BookCollection
    {
        return new BookCollection($this->model->filter($request)->where('owner_id', '=', auth()->user()->id)->paginate($request->input('page_size')));
    }

    public function addBookToFavorite(Book $book): JsonResponse
    {
        $user = auth()->user();
        if ($book->owner_id !== $user->id) {
            if ($user->favoritBooks()->where('id', $book->id)->exists()) {
                return ApiResponse::success(null, 'book already added');
            }
            $user->favoritBooks()->attach($book);
            return ApiResponse::success(null, 'book added success');
        }
        return ApiResponse::error('not Found Book');
    }

    public function deleteBookToFavorite(Book $book): JsonResponse
    {
        $user = auth()->user();
        if ($book->owner_id !== $user->id) {
            $user->favoritBooks()->detach($book);
            return ApiResponse::success(null, 'book deleted success');
        }
        return ApiResponse::error('not Found Book');
    }

    public function favoriteBooks(Request $request): BookCollection
    {
        $user = auth()->user();
        return new BookCollection($user->favoritBooks()->filter($request)->paginate($request->input('page_size')));
    }
}
