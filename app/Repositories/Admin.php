<?php

namespace App\Repositories;

use App\Interfaces\Admin as AdminInterface;
use App\Models\Admin as ModelsAdmin;
use Illuminate\Support\Facades\DB;
use stdClass;

class Admin implements AdminInterface
{
    private $table = 'admins';

    public function findByEmail(string $email): stdClass
    {
        return DB::table($this->table)->where('email', $email)->first();
    }
    public function insert(array $insertableData): void
    {
        DB::table($this->table)->insert($insertableData);
    }
    public function findByEmailWithModel(string $email): ModelsAdmin
    {
        return ModelsAdmin::where('email', $email)->first();
    }
}