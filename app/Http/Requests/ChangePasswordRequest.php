<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
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
            'oldpassword' => ['required', 'string'],
            'newpassword' => ['required', 'string'],
            'confirmpassword' => ['required', 'string'],
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'oldpassword' => $this->oldpassword, 
        ]);
    }
}
