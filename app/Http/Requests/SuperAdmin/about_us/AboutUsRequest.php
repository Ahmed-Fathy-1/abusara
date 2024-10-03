<?php

namespace App\Http\Requests\SuperAdmin\about_us;

use Illuminate\Foundation\Http\FormRequest;

class AboutUsRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'mission' => 'nullable|string',
            'value' => 'nullable|string',
            'value_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'vision' => 'nullable|string',
            'vision_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'team' => 'nullable|string',
            'team_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'description.required' => 'The description field is required.',
            'mission.required' => 'The mission field is required.',
            'image.image' => 'The image must be a valid image file.',
            'image.mimes' => 'The image must be in jpg, jpeg, or png format.',
            'image.max' => 'The image size cannot exceed 2MB.',
            'value_image.mimes' => 'The value image must be in jpg, jpeg, or png format.',
            'vision_image.mimes' => 'The vision image must be in jpg, jpeg, or png format.',
            'team_image.mimes' => 'The team image must be in jpg, jpeg, or png format.',
        ];
    }
}
