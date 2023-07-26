<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
        //return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:64',
            'email' => 'required|string|unique:employees,email',
            'position' => 'required|string|max:64',
            'birthday' => 'required|date',
            'address' => 'required|string|max:128',
            'address2' => 'nullable|string|max:128',
            'city' => 'required|string|max:64',
            'country' => 'required|string|max:64',
            'cp' => 'required|string|min:5|max:16',
            'skills.*.skill' => 'required|string|max:64',
            'skills.*.score' => 'required|digits_between:1,5'
        ];
    }
}
