<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            //'username'=>'required|unique:register_user,username',
            'username'=>'required',
            'phone_number'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'

        ];
    }

    // public function messages()
    // {
    //     return [
    //         'username.unique' => 'Sorry, this username has already been taken!',
    //     ];
    // }
}
