<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HasilProduksiRequest extends FormRequest
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
            'hasil_produksi' => 'required|string|min:2',
            'interval' => 'required|string',
            'deskripsi' => 'required|string|min:5|max:255',
            'bobot' => 'required|numeric|min:1|max:5',
        ];
    }
}
