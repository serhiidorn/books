<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RateBookRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rating' => ['required', 'int', 'min:1', 'max:5']
        ];
    }
}
