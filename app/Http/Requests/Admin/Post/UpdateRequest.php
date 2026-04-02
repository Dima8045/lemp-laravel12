<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'is_published' => 'sometimes|boolean',
            'published_at' => 'nullable',
            'user_id' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'delete_image' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Поле "Заголовок" є обов\'язковим.',
            'title.string' => 'Поле "Заголовок" повинно бути рядком.',
            'title.min' => 'Поле "Заголовок" має містити не менше 3 символів.',
            'title.max' => 'Поле "Заголовок" має містить не больше 255 символов.',
            'excerpt.required' => 'Поле "Краткий опис" є обов\'язковим.',
            'excerpt.string' => 'Поле "Краткий опис" повинно бути рядком.',
            'excerpt.min' => 'Поле "Краткий опис" має містити не менше 10 символів.',
            'excerpt.max' => 'Поле "Краткий опис" має містить не больше 255 символов.',
            'body.required' => 'Поле "Текст поста" є обов\'язковим.',
            'body.string' => 'Поле "Текст поста" повинно бути рядком.',
            'body.min' => 'Поле "Текст поста" має містити не менше 10 символів.',
            'image.image' => 'Файл повинен бути зображенням.',
            'image.mimes' => 'Зображення повинно бути в форматі jpeg, png, jpg або webp.',
            'image.max' => 'Розмір зображення не повинен перевищувати 2048 кілобайт.',
        ];
    }

        public function prepareForValidation(): void
        {
            $this->merge([
                'is_published' => $this->boolean('is_published'),
                'delete_image' => $this->boolean('delete_image'),
            ]);
        }
}
