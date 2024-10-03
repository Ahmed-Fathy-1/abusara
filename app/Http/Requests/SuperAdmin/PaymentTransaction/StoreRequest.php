<?php

namespace App\Http\Requests\SuperAdmin\PaymentTransaction;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            // "user_id" => "required|string|max:20",
            "package_id" => "required|string|max:20",
            'total' => 'nullable|numeric|max:999999999999999.99', 
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ];
    }
}
