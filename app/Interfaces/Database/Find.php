<?php

namespace App\Interfaces\Database;

use stdClass;

interface Find
{
    public function find(int $id): stdClass;
}