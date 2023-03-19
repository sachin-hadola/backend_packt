<?php

namespace App\Helpers;

use Illuminate\Http\Client\Response;

interface Api
{
    public function get($endpoint): Response;
}