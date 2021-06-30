<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogsCreateRequest extends FormRequest
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
            'blog_category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'photo_id' => 'required'
        ];
    }

    public function messages(){
        return [

            'title.required' => 'Blog Title is required!',
            'description.required' => 'Blog description is required',
            'photo.required' => 'Blog Photo is required!',
            'blog_category_id' => 'Select Blog Category!'
        ];
    }
}
