<?php

namespace App\Interfaces\Services\Frontend;

use App\Http\Requests\Frontend\Books\Index;
use stdClass;

interface Book
{
    public function searchWithFilter(Index $request): array;
    public function find(int $id): stdClass;
}