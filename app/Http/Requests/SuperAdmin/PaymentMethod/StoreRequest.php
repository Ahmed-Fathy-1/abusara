<?php

namespace App\Http\Requests\SuperAdmin\PaymentMethod;

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
            "name_en" => "required|string|max:255",
            "name_ar" => "required|string|max:255",
            "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            // "status" => "nullable|boolean",
            // "user_id" => "required|integer|exists:users,id",
        ];

    }
}
