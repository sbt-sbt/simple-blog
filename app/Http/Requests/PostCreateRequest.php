<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title'=>'required|min:6',
            'slug'=>'unique:posts',
            'description'=>'required',
            'photo'=>'required',
            'category'=>'required',
            'status'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'لطفا عنوان مطلب را وارد کنید',
            'slug.unique'=>'این نامک قبلا ثبت شده است',
            'title.min'=>'عنوان مطلب باید بیش از 6 کاراکتر باشد',
            'description.required'=>'لطفا توضیحات مطلب را وارد کنید',
            'photo.required'=>'لطفا تصویر شاخص مطلب را انتخاب کنید',
            'category.required'=>'لطفا دسته بندی مطلب را مشخص نمایید',
            'status.required'=>'وضعیت مطلب نامشخص است',
        ];
    }
}
