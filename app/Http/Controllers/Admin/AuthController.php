<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\Login;
use App\Http\Resources\Admin\Auth\Login as LoginResource;
use App\Http\Resources\Admin\Auth\Logout as LogoutResource;
use App\Interfaces\Services\Admin\Auth as AuthServiceInterface;
use Illuminate\Http\Response;
use Auth;

class AuthController extends Controller
{
    private AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Valid login credentials
     * 
     * @param  \App\Http\Requests\Admin\Auth\Login $request
     * @return \App\Http\Resources\Admin\Auth\Login
     */
    public function login(Login $request)
    {
        if (!$this->authService->validCredential($request)) {
            return response()->json([
                'error' => trans('auth.invalid_credential'),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $this->authService->revokeAllExistingToken($request);
        $request->merge(['access_token' => $this->authService->createToken($request)]);
        
        return new LoginResource($request);
    }

     /**
     * Valid login credentials
     * 
     * @return \App\Http\Resources\Admin\Auth\Logout
     */
    public function logout()
    {
        $this->authService->revokeToken(Auth::guard('sanctum')->user());

        return new LogoutResource([]);
    }
}
