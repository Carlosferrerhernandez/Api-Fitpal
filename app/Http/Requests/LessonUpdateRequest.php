<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'type' => ['required', 'in:on-site,on-line'],
            'trainer_id' => ['required', 'exists:trainers,id'],
            'gym_id' => ['nullable', 'exists:gyms,id'],
            'limit' => ['required', 'numeric'],
        ];
    }
}
