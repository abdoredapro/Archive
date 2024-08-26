<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class FileRequest extends FormRequest
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
        $id = $this->route('file');
        
        return [
            'project_id' => ['required', 'int', 'exists:projects,id'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png,gif,svg'],
            'video' => ['required','mimes:mp4','mimetypes:video/mp4'],
            'description'   => ['required', 'string'],
            'info' => ['string'],
        ];
    }


    protected function failedValidation(ValidationValidator $validator)
    {
        $errors = $validator->errors(); 

        return response()->json([
            'message' => 'Invalid data send',
            'details' => $errors->messages(),
        ], 422);

    }
}
