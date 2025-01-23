<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuCreateRequest extends FormRequest{

    public function rules(): array
    {
        return [ 
            'id',
            'image' => 'required',
            'logoImage'=>'required',
            'user_id'=>'required',
        ];
    }

}