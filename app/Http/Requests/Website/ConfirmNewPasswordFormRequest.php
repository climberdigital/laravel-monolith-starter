<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmNewPasswordFormRequest extends FormRequest
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
            'password' => ['required', 'confirmed', 'string', 'min:12', 'max:32'],
            'email' => ['required', 'email', 'exists:users,email'],
            'token' => ['required', 'string', 'exists:password_resets,token'],
        ];
    }
}
