<?php

namespace App\Interfaces\Database;

use stdClass;

interface FindByEmail
{
    public function findByEmail(string $email): stdClass;
}