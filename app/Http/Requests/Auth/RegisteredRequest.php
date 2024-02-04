<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Auth\RegisteredUserController;

class RegisteredRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'password' => ['required', 'confirmed', 'string', 'min:8',
                'regex:/[A-Z]/', 'regex:/[a-z]/',
                'regex:/[0-9]/', 'regex:/[@$!%*#?&]/' ],
        ];
    }
}
