<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuCreateRequest;
use App\Services\Implementations\MenuService;
use App\Services\Specifications\ImenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public MenuService $menuService; 

    /**
     * Dependency injection constructor, inject controller dependencies
     *
     * @param MenuService $MenuService The service to be injected for MenuService-related operations.
     */

    public function __construct(ImenuService $menuService)
    {
        $this->menuService=$menuService;
    }
    
    public function index(){
       return $this->menuService->index();
    }


    public function store(MenuCreateRequest $menuCreateRequest){
      return  $this->menuService->store($menuCreateRequest);
    }


    public function update(MenuCreateRequest $menuCreateRequest){
      return $this->menuService->update($menuCreateRequest);
    }

    
    public function delete($id){
      return $this->menuService->delete($id);
      
    }

    










}
