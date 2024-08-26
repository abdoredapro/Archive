<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;

class ClipRequest extends FormRequest
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
            'file_id'   => ['required', 'int', 'exists:files,id'],
            'name'      => ['required', 'string', 'max:255'],
            'file'      => ['required', 'string'],
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
