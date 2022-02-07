<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationFormRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                app()->environment(['local', 'testing'])
                    ? 'email'
                    : 'email:rfc,dns',
                'unique:users,email',
                'max:255'
            ],
            'extra' => ['prohibited'] // the hidden field for honey-pot technique
        ];
    }
}
