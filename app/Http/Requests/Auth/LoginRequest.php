<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Поле електронної пошти є обов\'язковим.',
            'email.string' => 'Поле електронної пошти повинно бути рядком.',
            'email.email' => 'Поле електронної пошти повинно бути дійсним адресом електронної пошти.',
            'password.required' => 'Поле пароля є обов\'язковим.',
            'password.string' => 'Поле пароля повинно бути рядком.',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'remember' => $this->boolean('remember'),
        ]);
    }
}
