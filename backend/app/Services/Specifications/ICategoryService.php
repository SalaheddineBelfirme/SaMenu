<?php

namespace App\Services\Specifications;

use App\Http\Requests\CategoryRequest;

interface ICategoryService {

    public function index();
    public function store(CategoryRequest $data);
    public function getByid($id);
    public function update (CategoryRequest $data);
    public function delete($id);


}