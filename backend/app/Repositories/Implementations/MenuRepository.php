<?php


namespace App\Repositories\Implementations;

use App\Models\Menu;
use App\Repositories\Specifications\IMenuRepository;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class MenuRepository implements IMenuRepository
{
    /**
     * Retrieve all contacts.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator Paginated list of contacts.
     */
    public function index()
    {
        return Menu::paginate(10);
    }
    public function store(array $data)
    {
        try {
            $data['id'] = Str::uuid()->toString();
          
            return Menu::create($data);
                
          } catch (Exception $e) {
            // Log the error for debugging
            Log::error('An error occurred while creating a new menu: ' . $e->getMessage());
            
        }
    }
    
    public function getById($id)
    {
        try {
            return Menu::find($id);
        } catch (Exception $e) {
            Log::error('an error occured while fetching menu: ' + $e->getMessage());
            abort(500, $e->getMessage());
        }
    }
    public function delete($id)
    {

        try {
            $menu = Menu::find($id);
            if($menu){
                return $menu->delete();
            }else{
                return false;
            }
        } catch (Exception $e) {
            Log::error('Error deleting menu: ' . $e->getMessage());
            abort(500, $e->getMessage());
        }
    }

    public function update(array $data)
    {
        try {
            $menu = Menu::findOrFail($data['id']);
            $menu->update($data);
            return $menu;
        } catch (Exception $e) {
            Log::error('an error occured while updating a menu: ' . $e->getMessage());
            abort(500, $e->getMessage());
        }
    }

}