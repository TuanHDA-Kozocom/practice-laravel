<?php

namespace App\Repositories;


use App\Models\User;
use App\Interfaces\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function store(array $data)
    {
        return User::create($data);
    }
}
