<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'details' => ['required', 'string'],
            'price' => ['required'],
            'quantity' => ['required', 'numeric'],
            'category_id' => ['required', 'exists:categories,id'],
            'media' => ['required', 'array'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // 'name.required' => "Judul Produk Harus di isi!",
            // 'details.required' => "Detail Produk Harus di isi!",
            // 'price.required' => "Harga Produk Harus di isi!",
            // 'quantity.required' => "Stok Produk Harus di isi!",
            // 'media.required' => "Media Harus di isi!",
        ];
    }
}
