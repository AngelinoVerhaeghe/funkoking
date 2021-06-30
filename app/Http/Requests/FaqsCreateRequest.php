<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqsCreateRequest extends FormRequest
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
            'faq_category_id' => 'required',
            'question' => 'required',
            'answer' => 'required'
        ];
    }

    public function messages(){
        return [
            'faq_category_id.required' => 'FAQ category is required!',
            'question.required' => 'FAQ question is required!',
            'answer.required' => 'FAQ answer is required!'
        ];
    }
}
