<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CareerHistoryFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'career_history' => ['array'],
            'career_history.career_id' => ['required', 'integer', 'exists:careers,id'],
            'career_history.start_date' => ['required', 'date'],
            'career_history.end_date' => ['nullable'],
            'career_history.skills' => ['array'],
            'career_history.skills.*' => ['required', 'integer', 'exists:skills,id'],
        ];
    }
}
