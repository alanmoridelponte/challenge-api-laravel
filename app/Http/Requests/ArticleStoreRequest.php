<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            'slug' => ['required', 'string', 'unique:articles,slug'],
            'status' => ['required', 'in:draft,published'],
            'published_at' => ['nullable'],
            'author_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
