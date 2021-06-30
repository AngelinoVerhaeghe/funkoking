<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'subcategory_id' => 'required',
            'category_id' => 'required',
            'name' => 'required|string',
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
            'price' => 'required'
        ];
    }

    public function messages(){
        return [
            'subcategory_id.required' => 'Subcategory is required!',
            'category_id.required' => 'Category is required!',
            'name.required' => 'Name is required!',
            'title.required' => 'Title is required!',
            'subtitle.required' => 'Subtitle is required!',
            'description.required' => 'Description is required!',
            'price.required' => 'Price is required!'
        ];
    }
}
