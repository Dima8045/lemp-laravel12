<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле імені є обов\'язковим.',
            'name.string' => 'Поле імені повинно быть рядком.',
            'name.max' => 'Поле імені не должно превышать 255 символов.',
            'email.required' => 'Поле електронної пошти є обов\'язковим.',
            'email.string' => 'Поле електронної пошти повинно быть рядком.',
            'email.email' => 'Поле електронної пошти повинно бути дійсним адресом електронної пошти.',
            'email.max' => 'Поле електронної пошти не должно превышать 255 символов.',
            'email.unique' => 'Такий email уже зарегистрирован.',
            'password.required' => 'Поле пароля є обов\'язковим.',
            'password.confirmed' => 'Підтвердження пароля не співпадає.',
            'password.min' => 'Пароль повинен бути не менше 8 символів.',
        ];
    }
}
