<?php

namespace App\Repositories;

use App\Interfaces\Book as BookInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class Book implements BookInterface
{
    private $table = 'books';

    public function searchWithFilter(array $where, string $sortBy, string $sortDir, int $page, int $limit): array
    {
        try {
            $offset = ($page - 1) * $limit;
            $query = DB::table($this->table);
            if (!empty($where)) {
                foreach($where as $conditon) {
                    $query = $query->where($conditon['column'], $conditon['operator'], $conditon['value']);
                }
            }
            $recordsFound = $query->count();
            $query = $query->orderBy($sortBy, $sortDir)->offset($offset)->take($limit)->get();
            return [
                'recordsTotal' => $recordsFound,
                'records' => $query
            ];
        } catch (QueryException $th) {
            throw $th;
        }
        
    }
    public function find(int $id): stdClass
    {
        $record = DB::table($this->table)->where('id', $id)->first();

        if (empty($record)) {
            return new stdClass;
        }
        
        return $record;
    }
    public function insert(array $insertableData): void
    {
        DB::table($this->table)->insert($insertableData);
    }
    public function delete(int $id): void
    {
        DB::table($this->table)->where('id', $id)->delete();
    }
    public function update(int $id, array $updatableData): void
    {
        DB::table($this->table)->where('id', $id)->update($updatableData);
    }
    public function get(array $filters = []): Collection
    {
        return DB::table($this->table)->get();
    }
}