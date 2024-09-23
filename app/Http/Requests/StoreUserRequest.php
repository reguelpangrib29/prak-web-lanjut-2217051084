<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:255|unique:user,npm',
            'kelas_id' => 'required|exists:kelas,id',
        ];
    }

    /**
     * Get the custom messages for validator errors.
     *
     * @return array<string, mixed>
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'The name field is required.',
            'npm.required' => 'The NPM field is required.',
            'npm.unique' => 'This NPM is already registered. Please use another NPM.',
            'kelas_id.required' => 'The class field is required.',
            'kelas_id.exists' => 'The selected class is invalid.',
        ];
    }
}
