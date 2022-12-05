<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    protected function prepareForValidation()
    {

        if (!$this->input('slug') || make_slug($this->input('title'), '-') != $this->input('slug')) {
            $this->merge(['slug'=> make_slug($this->input('title'), '-')]) ;
        }
    }

    public function rules()
    {
        return [
            'title'=>'required',
            'slug'=>'unique:categories',
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'لطفا عنوان مطلب را وارد کنید',
            'slug.unique'=>'این نامک قبلا ثبت شده است',
        ];
    }
}
