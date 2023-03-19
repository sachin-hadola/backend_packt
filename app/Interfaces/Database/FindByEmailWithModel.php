<?php

namespace App\Interfaces\Database;

use App\Models\Admin;

interface FindByEmailWithModel
{
    public function findByEmailWithModel(string $email): Admin;
}