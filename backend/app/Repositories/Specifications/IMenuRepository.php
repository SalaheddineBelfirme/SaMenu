<?php

namespace App\Repositories\Specifications;

interface IMenuRepository
{
    public function index ();
    public function store (array $data);
    public function getById ($id);
    public function delete($id);
    public function update(array $data);

}