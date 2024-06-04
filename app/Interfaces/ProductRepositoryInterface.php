<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function index();
    public function store(array $data);
    public function update(array $data, $id);
}
