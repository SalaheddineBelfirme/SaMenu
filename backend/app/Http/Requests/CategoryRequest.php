<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest{

    public function rules(): array
    {
        return [ 
            'id',
            'menu_id' => 'required',
            'name'=>'required',
        ];
    }

}