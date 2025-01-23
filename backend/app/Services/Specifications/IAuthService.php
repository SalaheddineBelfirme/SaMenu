<?php

namespace App\Services\Specifications;

use App\Http\Requests\UserCreateRequest;
use GuzzleHttp\Psr7\Request;

interface IAuthService
{
    public function register(UserCreateRequest $userCreateRequest );

    public function login(array $data);

    public function logout();
}