<?php

namespace App\Services\Implementations;

use App\Http\Requests\MenuCreateRequest;
use App\Repositories\Implementations\MenuRepository;
use App\Services\Specifications\ImenuService;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class MenuService implements ImenuService
{

    private MenuRepository $menuRepository;
    /**
     * Dependency injection constructor, inject service dependencies
     * 
     * @param MenuRepository $MenuRepository MenuRepository-related operations repositry
     */

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function index()
    {
        return $this->menuRepository->index();
    }

    public function store(MenuCreateRequest $data)
    {
        $cloudinaryImage = $data->file('image')->storeOnCloudinary('samenu');
        $url = $cloudinaryImage->getSecurePath();
        $public_id = $cloudinaryImage->getPublicId();
        $data['image_url'] = $url;
        $data['image_public_id'] = $public_id;

        $cloudinaryLogo = $data->file('logoImage')->storeOnCloudinary('samenu');
        $urlLogo = $cloudinaryLogo->getSecurePath();
        $data['logo'] = $urlLogo;

        return  $this->menuRepository->store($data->all());
    }
    public function getByid($id)
    {
        return $this->menuRepository->getById($id);
    }
    public function update(MenuCreateRequest $request)
    {
        $menu=$this->menuRepository->getById($request->id);       
        if ($request->hasFile('image')) {
            Cloudinary::destroy($menu->image_public_id);
            $cloudinaryImage = $request->file('image')->storeOnCloudinary('samenu');
            $url = $cloudinaryImage->getSecurePath();
            $public_id = $cloudinaryImage->getPublicId();
            $request['image_url'] = $url;
            $request['image_public_id'] = $public_id;
        }
        if ($request->hasFile('logoImage')) {
            Cloudinary::destroy($menu->image_public_id);
            $cloudinaryLogo = $request->file('logoImage')->storeOnCloudinary('samenu');
            $urlLogo = $cloudinaryLogo->getSecurePath();
            $request['logo'] = $urlLogo;
        }

        return   $this->menuRepository->update($request->all());
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
            $deleted = $this->menuRepository->delete($id);
    
            if ($deleted==true) {
                return response()->json([
                    'success' => true,
                    'message' => 'The menu item has been deleted.',
                ], 200);
            } 
            else($deleted);
                return response()->json([
                    'success' => false,
                    'message' => "No menu item found with ID $id.",
                ], 404);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the menu item.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
}
