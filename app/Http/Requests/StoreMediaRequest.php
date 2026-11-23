<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('PATCH')) {
            $media = $this->route('media');

            return [
                'title' => ['sometimes', 'string', 'max:255', Rule::unique('media', 'title')->ignore($media)],
                'type' => 'sometimes|string|max:50',
                'genre' => 'sometimes|nullable|string|max:50',
                'description' => 'sometimes|nullable|string',
            ];
        }

        return [
            'title' => 'required|string|max:255|unique:media,title',
            'type' => 'required|string|max:50',
            'genre' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul media wajib diisi',
            'title.unique' => 'Judul media sudah ada',
            'type.required' => 'Jenis media wajib diisi',
        ];
    }
}