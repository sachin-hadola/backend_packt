<?php

namespace App\Interfaces\Database;

use Illuminate\Support\Collection;

interface Get
{
    public function get(array $filters = []): Collection;
}