<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'title_az' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'title_ru' => ['required', 'string', 'max:255'],
            'description_az' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'description_ru' => ['required', 'string'],
            'cost_price' => ['required', 'numeric','min:0.01','max:999.99'],
            'sale_price' => ['required', 'numeric','min:0.01','max:999.99'],
            'discount' => ['required', 'numeric','min:0.00'],
            'image' => ['required', 'image', 'mimes:png,jpg,svg,webp', 'max:2048'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ];
    }
}
