<?php

namespace App\Http\Requests;

use App\Enums\UserGenderEnum;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserVaccineRegisterRequest extends FormRequest
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
            'full_name' => ['required', 'string', 'max:255'],
            'email'     => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users',
            ],
            'mobile'            => ['required', 'string', 'max:20', 'unique:users'],
            'nid'               => ['required', 'string', 'max:30', 'unique:users'],
            'vaccine_center_id' => ['required'],
            'gender'            => ['required', Rule::enum(UserGenderEnum::class)],
        ];
    }
}
