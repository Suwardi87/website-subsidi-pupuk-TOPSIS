<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DosisPemupukanRequest extends FormRequest
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
            'komoditas_id' => 'required|exists:komoditas,id',
            'musim_tanam_id' => 'required|exists:musim_tanams,id',
            'dosis_pemupukan' => 'required|string|min:2',
        ];
    }
}
