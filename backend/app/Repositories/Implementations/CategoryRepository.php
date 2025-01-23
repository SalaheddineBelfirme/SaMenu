<?php


namespace App\Repositories\Implementations;

use App\Models\Category;
use App\Repositories\Specifications\ICategoryRepository;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class CategoryRepository implements ICategoryRepository
{
    /**
     * Retrieve all contacts.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator Paginated list of contacts.
     */
    public function index()
    {
        return Category::paginate(10);
    }
    public function store(array $data)
    {
        try {
            $data['id'] = Str::uuid()->toString();
            $category = Category::create($data);
            return $category;
          } catch (Exception $e) {
            dd($e);
            Log::error('An error occurred while creating a new Category: ' . $e->getMessage());
            
        }
    }
    
    public function getById($id)
    {
        try {
            return Category::find($id);
        } catch (Exception $e) {
            Log::error('an error occured while fetching Category: ' + $e->getMessage());
            abort(500, $e->getMessage());
        }
    }
    public function delete($id)
    {

        try {
            $category = Category::find($id);
            if($category){
                return $category->delete();
            }else{
                return false;
            }
        } catch (Exception $e) {
            Log::error('Error deleting Category: ' . $e->getMessage());
            abort(500, $e->getMessage());
        }
    }

    public function update(array $data)
    {
        try {
            $category = Category::findOrFail($data['id']);
            $category->update($data);
            return $category;
        } catch (Exception $e) {
            Log::error('an error occured while updating a Category : ' . $e->getMessage());
            abort(500, $e->getMessage());
        }
    }

}