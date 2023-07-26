<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SkillRequest extends FormRequest
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
            'skill' => 'required|string|max:64',
            'score' => 'required|numeric|digits_between:1,5',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'skill.required' => 'skill is required!',
            'score.required' => 'score is required!',
            'score.numeric' => 'score is numeric!',
            'score.digits_between' => 'score need between 1 and 5!'
        ];
    }
}
