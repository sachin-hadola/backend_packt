<?php

namespace App\Interfaces\Services\Admin;

use App\Http\Requests\Admin\Auth\Login;
use App\Models\Admin;

interface Auth
{
    public function validCredential(Login $request): bool;
    public function createToken(Login $request): string;
    public function revokeAllExistingToken(Login $request): void;
    public function revokeToken(Admin $admin): void;
}