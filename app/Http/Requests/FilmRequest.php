<?php

namespace App\Http\Requests;

use App\Models\Film;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;

class FilmRequest extends FormRequest
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
            'category_id'   => ['required', 'int', 'exists:categories,id'],
            'name'          => ['required', 'string'],
            'image'         => ['required', 'image', 'mimes:jpeg,jpg,png,gif,svg'],
            'video'         => ['required','mimes:mp4','mimetypes:video/mp4'],
            'film_script'   => ['required', 'string'],
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
