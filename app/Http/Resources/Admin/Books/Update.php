<?php

namespace App\Http\Resources\Admin\Books;

use Illuminate\Http\Resources\Json\JsonResource;

class Update extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'message' => trans('book.success.updated'),
            'data' => []
        ];
    }
}
