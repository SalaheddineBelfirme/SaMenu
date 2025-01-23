<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategryRequest;
use App\Http\Requests\MenuCreateRequest;
use App\Services\Implementations\CategoryService;
use App\Services\Specifications\ICategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public CategoryService $categoryService; 

    /**
     * Dependency injection constructor, inject controller dependencies
     *
     * @param CategoryService $CategoryService The service to be injected for MenuService-related operations.
     */

    public function __construct(ICategoryService $categoryService)
    {
        $this->categoryService=$categoryService;
    }
    
    public function index(){
       return $this->categoryService->index();
    }


    public function store(CategoryRequest $categoryRequest){
      return  $this->categoryService->store($categoryRequest);
    }


    public function update(categoryRequest $categoryRequest){
      return $this->categoryService->update($categoryRequest);
    }

    
    public function delete($id){
      return $this->categoryService->delete($id);
      
    }

}
