<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class StartUserPasswordResetFormRequest extends FormRequest
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
            'email' => ['required', 'string', 'exists:users,email', 'max:255'],
            'extra' => ['prohibited'], // the hidden field for honey-pot technique
        ];
    }

    public function messages()
    {
        return [
            'email.*' => __('auth.failed'),
        ];
    }
}
