<?php

namespace App\Services\Implementations;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategryRequest;
use App\Http\Requests\MenuCreateRequest;
use App\Repositories\Implementations\CategoryRepository;
use App\Repositories\Implementations\MenuRepository;
use App\Services\Specifications\ICategoryService;
use App\Services\Specifications\IContactService;
use App\Services\Specifications\ImenuService;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CategoryService implements ICategoryService
{

    private CategoryRepository $categoryRepository;
    /**
     * Dependency injection constructor, inject service dependencies
     * 
     * @param categoryRepository $categoryRepository MenuRepository-related operations repositry
     */

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        return $this->categoryRepository->index();
    }

    public function store(CategoryRequest $data)
    {
        return  $this->categoryRepository->store($data->all());
    }
    public function getByid($id)
    {
        return $this->categoryRepository->getById($id);
    }
    public function update(CategoryRequest $request)
    {        
        return   $this->categoryRepository->update($request->all());
    }
    public function delete($id)
    {
        if (!$id) {
            return response()->json([
                'success' => false,
                'message' => 'No ID provided !',
            ], 400);
        }
    
        try {
            $deleted = $this->categoryRepository->delete($id);
            if ($deleted==true) {
                return response()->json([
                    'success' => true,
                    'message' => 'The category item has been deleted.',
                ], 200);
            } 
            else($deleted);
                return response()->json([
                    'success' => false,
                    'message' => "No category item found with ID $id.",
                ], 404);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the category ',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
}
