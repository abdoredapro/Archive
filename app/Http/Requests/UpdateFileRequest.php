<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFileRequest extends FormRequest
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
            'image'         => ['image', 'mimes:jpg,jpeg,png,gif,svg'],
            'video'         => ['mimes:mp4', 'mimetypes:video/mp4'],
            'project_id'    => ['required', 'int', 'exists:projects,id'],
            'name'          => ['required', 'string', 'min:3', 'max:255'],
            'description'   => ['required', 'string'],
            'file_clip_name' => [
                Rule::requiredIf(function () {
                    return $this->has('file_clip_clip');
                }),
                'max:255'
            ],
            'minute' => [
                Rule::requiredIf(function () {
                    return $this->has('file_clip_clip');
                }),
            ],
            'second' => [
                Rule::requiredIf(function () {
                    return $this->has('file_clip_clip');
                }),
            ],
            'foot_description' => ['nullable', 'string'],

        ];
    }
}
