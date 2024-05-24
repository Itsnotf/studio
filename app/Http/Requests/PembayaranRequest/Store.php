<?php

namespace App\Http\Requests\PembayaranRequest;

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
            'image'=>'nullable|max:2048|mimes:jpg,jpeg,png,gif',
            'wallet'=>'required',
            'no_wallet'=>'required',
            'an'=>'required',
        ];
    }
}
