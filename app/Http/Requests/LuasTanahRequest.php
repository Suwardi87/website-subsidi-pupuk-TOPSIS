<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LuasTanahRequest extends FormRequest
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
            'luas_lahan' => 'required',
            'interval' => 'required|string',
            'bobot' => 'required|numeric|min:1|max:5',
        ];
    }
}
