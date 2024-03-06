<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;

class ChangePasswordRequest extends FormRequest
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
            'password_old' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8']
        ];
    }

    /**
     * Generate validation message if fail.
     * 
     * @param Validator $validator
     * 
     * @throws Illuminate\Http\RedirectResponse
     */
    protected function failedValidation(Validator $validator): RedirectResponse
    {
        return redirect(status: 400)->to(path: route(name: 'dashboard-change-password-page'))
            ->withErrors(provider: $validator->getMessageBag());
    }
}
