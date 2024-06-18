<?php

namespace App\Http\Controllers\Private;


use App\Http\Services\Private\AuthService;
use Illuminate\Http\Request;


class AuthController
{

    public function __construct()
    {
        $this->service = new AuthService();
    }

    public function register(Request $request)
    {
        return $this->service->register($request);
    }

    public function login(Request $request)
    {
        return $this->service->login($request);
    }

    public function getUser(Request $request)
    {
        return $this->service->getUser($request);
    }

    public function logout()
    {
        return $this->service->logout();
    }

}
