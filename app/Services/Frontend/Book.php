<?php

namespace App\Services\Frontend;

use App\Http\Requests\Frontend\Books\Index;
use App\Interfaces\Book as BookInterface;
use App\Interfaces\Services\Frontend\Book as BookServiceInterface;
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
    public function find(int $id): stdClass
    {
        return $this->book->find($id);
    }
}