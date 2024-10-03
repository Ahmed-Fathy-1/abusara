<?php

namespace App\Http\Requests\SuperAdmin\Package;

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
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'subtitle_en' => 'nullable|string|max:255',
            'subtitle_ar' => 'nullable|string|max:255',
            'description_en' => 'nullable|string|max:255',
            'description_ar' => 'nullable|string|max:255',
            "status" => "nullable|boolean",
            // "user_id" => "required|integer|exists:users,id",
        ];
    }
}
