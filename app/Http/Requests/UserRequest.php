<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=>'required',
            'email'=>'required',
            'roles'=>'required',
            'status'=>'required',
            'password'=>'required|min:3',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'لطفا نام و نام خانوادگی را وارد کنید',
            'email.required'=>'لطفا ایمیل را وارد کنید',
            'roles.required'=>'لطفا نقش را وارد کنید',
            'status.required'=>'لطفا وضعیت را وارد کنید',
            'password.required'=>'لطفا رمز عبور را وارد کنید',
            'password.min'=>'رمز عبور باید بیشتر از سه کارکتر باشد',
        ];
    }
}
