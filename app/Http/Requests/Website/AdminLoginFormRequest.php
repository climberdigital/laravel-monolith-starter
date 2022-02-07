<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginFormRequest extends FormRequest
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
            'login' => ['required', 'string', 'exists:admins,login', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
            'remember_me' => ['boolean'],
            'extra' => ['prohibited'], // the hidden field for honey-pot technique
        ];
    }

    /**
     * Override the Laravel's default validation messages
     * to hide the specific reasons of failed auth,
     * as an extra security measure.
     */
    public function messages()
    {
        return [
            'login.*' => __('auth.failed'),
            'password.*' => __('auth.failed'),
        ];
    }
}
