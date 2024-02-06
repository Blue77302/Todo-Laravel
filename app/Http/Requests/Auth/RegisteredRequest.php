<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisteredRequest extends FormRequest
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
            'first_name' => [
                'required',
                'string',
                'max:30',
                'alpha' ],
            'last_name' => [
                'required',
                'string',
                'max:30',
                'alpha'],
            'email' => [
                'required',
                'string',
                'email',
                'max:100',
                'unique:users,email',
            ],
            'password' => ['required', 'confirmed',
            Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()
            ],
        ];
    }
}
