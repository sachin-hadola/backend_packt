<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\Auth\Login;
use App\Interfaces\Services\Admin\Auth as AuthInterface;
use App\Interfaces\Admin as AdminInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin as AdminModel;

class Auth implements AuthInterface
{
    private AdminInterface $admin;

    public function __construct(AdminInterface $admin)
     {
        $this->admin = $admin;
     }

    public function validCredential(Login $request): bool
    {
        $admin = $this->admin->findByEmail($request->email);
        if (Hash::check($request->password, $admin->password)) {
            return true;
        }

        return false;
    }
    public function createToken(Login $request): string
    {
        $admin = $this->admin->findByEmailWithModel($request->email);

        return $admin->createToken('ADMIN ACCESS')->plainTextToken;
    }
    public function revokeAllExistingToken(Login $request): void
    {
        $admin = $this->admin->findByEmailWithModel($request->email);
        foreach ($admin->tokens as $token) {
            $token->delete();
        }
    }
    public function revokeToken(AdminModel $admin): void
    {   
        $admin->currentAccessToken()->delete();
    }
}