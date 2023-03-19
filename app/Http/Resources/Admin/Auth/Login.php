<?php

namespace App\Http\Resources\Admin\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class Login extends JsonResource
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
            'message' => '',
            'data' => [
                'access_token' => $this->access_token
            ]
        ];
    }
}
