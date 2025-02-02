<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProsesRequest extends FormRequest
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
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            // 'luas_tanah_id' => 'required|integer',
            // 'komoditas_id' => 'required|integer',
            // 'musim_tanam_id' => 'required|integer',
            // 'dosis_pemupukan_id' => 'required|integer',
            'luas_lahan' => 'required',
            'biaya_produksi' => 'required',
            'hasil_produksi' => 'required',
            'dosis_pemupukan' => 'required',
        ];
    }
}
