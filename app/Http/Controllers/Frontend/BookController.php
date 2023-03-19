<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Books\Index;
use App\Http\Resources\Frontend\Books\Index as ListBooksResource;
use App\Http\Resources\Frontend\Books\Detail as DetailBooksResource;
use App\Interfaces\Services\Frontend\Book as BookServiceInterfce;
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
     * @param  \App\Http\Requests\Frontend\Books\Index $request
     * @return \App\Http\Resources\Frontend\Books\Index
     */
    public function index(Index $request)
    {
        $records = $this->bookService->searchWithFilter($request);

        return new ListBooksResource($records);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \App\Http\Resources\Frontend\Books\Detail
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
}
