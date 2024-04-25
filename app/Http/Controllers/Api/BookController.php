<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookFilterRequest;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookCollection;
use App\Interfaces\BookRepositoryInterface;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * @var BookRepositoryInterface
     */
    private BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request|BookFilterRequest  $request
     * @return BookCollection
     */
    public function index(BookFilterRequest $request): BookCollection
    {
        return $this->bookRepository->index($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBookRequest  $request
     * @return JsonResponse
     */
    public function store(StoreBookRequest $request): JsonResponse
    {
        return $this->bookRepository->store($request->validated());
    }

    /**
     * @param UpdateBookRequest $request
     * @param Book $book
     * @return JsonResponse
     */
    public function update(UpdateBookRequest $request, Book $book): JsonResponse
    {
        return $this->bookRepository->update($request->validated(), $book);
    }

    /**
     * @param Book $product
     * @return JsonResponse
     */
    public function show(Book $book): JsonResponse
    {
        return $this->bookRepository->show($book);
    }

    public function uploadAttachments(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg'
        ]);
        return $this->bookRepository->uploadAttachments($request);
    }

    public function deleteAttachment(Request $request): JsonResponse
    {
        $request->validate([
            'path' => 'required'
        ]);
        return $this->bookRepository->deleteAttachment($request->input('path'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request|BookFilterRequest  $request
     * @return BookCollection
     */
    public function getBooksToAuthUser(BookFilterRequest $request): BookCollection
    {
        return $this->bookRepository->getBooksToAuthUser($request);
    }

    public function delete(Book $book):JsonResponse{
        return $this->bookRepository->delete($book);
    }
}
