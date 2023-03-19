<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\Books\Index;
use App\Http\Requests\Admin\Books\Store;
use App\Http\Requests\Admin\Books\Update;
use App\Interfaces\Book as BookInterface;
use App\Interfaces\Services\Admin\Book as BookServiceInterface;
use stdClass;

class Book implements BookServiceInterface
{
    private BookInterface $book;

    public function __construct(BookInterface $book)
    {
        $this->book = $book;
    }
    public function searchWithFilter(Index $request): array
    {
        $conditions = [];
        $where = $request->search;
        if (!empty($where)) {
            $where = array_filter($request->search);
            if (!empty($where)) {
                $i = 0;
                foreach($where as $key => $condition) {
                    $conditions[$i]['column'] = $key;
                    $conditions[$i]['operator'] = 'like';
                    $conditions[$i]['value'] = '%'.$condition.'%';
                    $i++;
                }
            }
        }
        return $this->book->searchWithFilter($conditions, !empty($request->sortBy) ? $request->sortBy : 'id', !empty($request->sortType) ? $request->sortType : 'asc', $request->page, $request->rowsPerPage);
    }
    public function store(Store $request): void
    {
        $insertableData = [
            'title' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
            'description' => $request->description,
            'isbn' => $request->isbn,
            'image' => $request->image,
            'published_on' => $request->published_on,
            'publisher' => $request->publisher,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $this->book->insert($insertableData);
    }
    public function find(int $id): stdClass
    {
        return $this->book->find($id);
    }
    public function update(Update $request, int $id): void
    {
        $updatableData = [
            'title' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
            'description' => $request->description,
            'isbn' => $request->isbn,
            'image' => $request->image,
            'published_on' => $request->published_on,
            'publisher' => $request->publisher,
            'updated_at' => now(),
        ];
        $this->book->update($id, $updatableData);
    }
    public function delete(int $id): void
    {
        $this->book->delete($id);
    }
}