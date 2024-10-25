<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStoreRequest extends FormRequest
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
            "first_name" => ['required', 'string'],
            "other_name" => ['required', "string"],
            "last_name" => ['required', 'string'],
            "date_of_birth" => ['required', "date"],
            "country" => ['required', 'string'],
            "state_of_origin" => ['required', 'string'],
            "gender" => ['required', 'string'],
            "mode_of_learning" => ['required', 'string'],
            "course" => ['required', 'string'],
            "email" => ['required', 'email', 'unique:users,email'],
            "password" => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
