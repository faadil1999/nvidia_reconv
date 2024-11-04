<?php

namespace App\Http\Requests;

use App\Enum\StepStatusEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class StepFormRequest extends FormRequest
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
            'career_path_id' => ['required', 'exists:career_paths,id', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable'],
            'order' => ['integer'],
            'status' => ['string', new Enum(StepStatusEnum::class)],
        ];
    }
}
