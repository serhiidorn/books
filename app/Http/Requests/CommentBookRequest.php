<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentBookRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'body' => ['required', 'string']
        ];
    }
}
