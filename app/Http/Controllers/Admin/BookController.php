<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Books\Index;
use App\Http\Requests\Admin\Books\Store;
use App\Http\Requests\Admin\Books\Update;
use App\Http\Resources\Admin\Books\Index as ListBooksResource;
use App\Http\Resources\Admin\Books\Store as StoreBooksResource;
use App\Http\Resources\Admin\Books\Detail as DetailBooksResource;
use App\Http\Resources\Admin\Books\Update as UpdateBooksResource;
use App\Http\Resources\Admin\Books\Delete as DeleteBooksResource;
use App\Interfaces\Services\Admin\Book as BookServiceInterfce;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    private BookServiceInterfce $bookService;

    public function __construct(BookServiceInterfce $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of the resource with pagination.
     * 
     * @param  \App\Http\Requests\Admin\Books\Index $request
     * @return \App\Http\Resources\Admin\Books\Index
     */
    public function index(Index $request)
    {
        $records = $this->bookService->searchWithFilter($request);

        return new ListBooksResource($records);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Books\Store  $request
     * @return \App\Http\Resources\Admin\Books\Store
     */
    public function store(Store $request)
    {
        $this->bookService->store($request);

        return new StoreBooksResource([]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \App\Http\Resources\Admin\Books\Detail
     */
    public function show($id)
    {
        $book = $this->bookService->find($id);
        if (empty((array) $book)) {
            return response()->json([
                'error' => trans('book.error.not_found'),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return new DetailBooksResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Books\Update  $request
     * @param  int  $id
     * @return \App\Http\Resources\Admin\Books\Update
     */
    public function update(Update $request, $id)
    {
        $book = $this->bookService->find($id);
        if (empty((array) $book)) {
            return response()->json([
                'error' => trans('book.error.not_found'),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $this->bookService->update($request, $id);

        return new UpdateBooksResource([]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \App\Http\Resources\Admin\Books\Delete
     */
    public function destroy($id)
    {
        $book = $this->bookService->find($id);
        if (empty((array) $book)) {
            return response()->json([
                'error' => trans('book.error.not_found'),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $this->bookService->delete($id);

        return new DeleteBooksResource([]);
    }
}
