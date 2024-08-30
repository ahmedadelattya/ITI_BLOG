<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\MaxPosts;


class UpdatePostRequest extends FormRequest
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
            "title" => ["required", "min:3", Rule::unique('posts', 'title')->ignore($this->post), new MaxPosts],
            "description" => "required|min:10",
            "image" => "image|mimes:jpeg,jpg,png,svg|max:2048"
        ];
    }
    public  function messages(): array
    {
        return [
            'title.required' => 'The title is required.',
            'title.unique' => 'The title has already been taken.',
            'title.min' => 'The title must be at least 3 characters.',
            'description.required' => 'The description is required.',
            'description.min' => 'The description must be at least 10 characters.',
            'image.required' => 'The image is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, jpg, png, svg.',
            'image.max' => 'The image size may not be greater than 2MB.',
        ];
    }
}
