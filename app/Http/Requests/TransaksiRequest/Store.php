<?php

namespace App\Http\Requests\TransaksiRequest;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'paket_id' => 'required|exists:pakets,id',
            'mtd_pembayaran_id' => 'required|exists:mtd_pembayarans,id',
            'bukti_pembayaran' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'telpon' => 'required|string',
        ];
    }
}
