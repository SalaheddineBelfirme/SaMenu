<?php

namespace App\Repositories\Specifications;

interface IUserRepository {

    public function register(array $data );

    public function findByEmail($email);

    // public function logout();
    
}