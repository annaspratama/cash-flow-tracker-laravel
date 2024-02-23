<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            'email' => ['required', 'email', 'unique:users', 'max:100'],
            'first_name' => ['required', 'max:50'],
            'last_name' => ['nullable', 'max:50'],
            'password' => ['required', 'min:8', 'max:30'],
            'g-recaptcha-response' => ['required']
        ];
    }

    /**
     * Generate validation message if fail.
     * 
     * @param Validator $validator
     * 
     * @throws HttpResponseException
     */
    // protected function failedValidation(Validator $validator): HttpResponseException
    // {
    //     throw new HttpResponseException(response([
    //         "errors" => $validator->getMessageBag()
    //     ], 400));
    // }
}
