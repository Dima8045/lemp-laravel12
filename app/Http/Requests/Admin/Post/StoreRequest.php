<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:255',
            'slug' => 'nullable',
            'excerpt' => 'required|string|min:10|max:255',
            'body' => 'required|string|min:10',
            'is_published' => 'nullable',
            'published_at' => 'nullable',
            'user_id' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Поле "Заголовок" є обов\'язковим.',
            'title.string' => 'Поле "Заголовок" повинно бути рядком.',
            'title.min' => 'Поле "Заголовок" має містити не менше 3 символів.',
            'title.max' => 'Поле "Заголовок" має містити не більше 255 символів.',
            'excerpt.required' => 'Поле "Краткий опис" є обов\'язковим.',
            'excerpt.string' => 'Поле "Краткий опис" має бути рядком.',
            'excerpt.min' => 'Поле "Краткий опис" має містити не менше 10 символів.',
            'excerpt.max' => 'Поле "Краткий опис" має містити не більше 255 символів.',
            'body.required' => 'Поле "Текст поста" є обов\'язковим.',
            'body.string' => 'Поле "Текст поста" має бути рядком.',
            'body.min' => 'Поле "Текст поста" має містити не менше 10 символів.',
            'image.image' => 'Файл повинен бути зображенням.',
            'image.mimes' => 'Зображення повинно бути у форматі jpeg, png, jpg або webp.',
            'image.max' => 'Размір зображення не повинен перевищувати 2048 кілобайт.',
        ];
    }
}
