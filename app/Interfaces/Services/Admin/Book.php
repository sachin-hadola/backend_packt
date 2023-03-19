<?php

namespace App\Interfaces\Services\Admin;

use App\Http\Requests\Admin\Books\Index;
use App\Http\Requests\Admin\Books\Store;
use App\Http\Requests\Admin\Books\Update;
use stdClass;

interface Book
{
    public function searchWithFilter(Index $request): array;
    public function store(Store $request): void;
    public function find(int $id): stdClass;
    public function update(Update $request, int $id): void;
    public function delete(int $id): void;
}