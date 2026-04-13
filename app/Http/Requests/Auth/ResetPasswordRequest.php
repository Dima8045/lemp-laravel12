<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'token' => ['required'],
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => 'Токен скидання пароля відсутній.',
            'email.required' => 'Ви не ввели електронну адресу.',
            'email.email' => 'Введіть коректну електронну адресу.',
            'email.exists' => 'Користувача з такою електронною адресою не знайдено.',
            'password.required' => 'Ви не ввели новий пароль.',
            'password.confirmed' => 'Паролі не співпадають.',
            'password.min' => 'Пароль повинен містити не менше 8 символів.',
        ];
    }
}
