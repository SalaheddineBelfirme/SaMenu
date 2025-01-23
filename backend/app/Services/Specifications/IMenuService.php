<?php

namespace App\Services\Specifications;

use App\Http\Requests\MenuCreateRequest;

interface ImenuService {

    public function index();
    public function store(MenuCreateRequest $data);
    public function getByid($id);
    public function update (MenuCreateRequest $data);
    public function delete($id);


}