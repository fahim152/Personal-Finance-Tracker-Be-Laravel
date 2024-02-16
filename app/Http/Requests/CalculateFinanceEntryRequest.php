<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CalculateFinanceEntryRequest extends BaseApiRequest
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
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }

    /**
     * Messages for validation failures.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'start_date.required' => 'The start date is required.',
            'start_date.date' => 'The start date must be a valid date.',
            'start_date.before_or_equal' => 'The start date must be before or equal to the end date.',
            'end_date.required' => 'The end date is required.',
            'end_date.date' => 'The end date must be a valid date.',
            'end_date.after_or_equal' => 'The end date must be after or equal to the start date.',
        ];
    }
}
