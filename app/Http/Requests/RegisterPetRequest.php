<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPetRequest extends FormRequest
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
            'name' => [
                'required',
            ], 
            'email' => [
                'required',
                'email',
                'unique:summit_2026'
            ],
            'control_number' => [
                'required',
            ], 
            'pets' => [
                'required',
            ], 
            'spend' => [
                'required',
            ], 
            'store' => [
                'required',
            ], 
            'brand' => [
                'required',
            ], 
            'bath' => [
                'required',
            ], 
            
        ];
    }
}
