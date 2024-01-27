<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['string', 'max:30', Rule::unique(User::class)->ignore($this->user()->id)],
            'last_name' => ['string', 'max:20', Rule::unique(User::class)->ignore($this->user()->id)],
            'Address' => ['string', 'max:200', Rule::unique(User::class)->ignore($this->user()->id)],
            'email' => ['string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }
}
