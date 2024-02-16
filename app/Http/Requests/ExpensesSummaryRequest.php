<?php
namespace App\Http\Requests;

use App\Constants\CategoryConstants;

class ExpensesSummaryRequest extends BaseApiRequest
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
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'category' => 'required|in:' . implode(',', [CategoryConstants::EXPENSE, CategoryConstants::INCOME]),
        ];
    }

    /**
     * Get custom messages for validation failures.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'start_date.required' => 'The start date is required.',
            'start_date.date' => 'The start date must be a valid date.',
            'end_date.required' => 'The end date is required.',
            'end_date.date' => 'The end date must be a valid date.',
            'end_date.after_or_equal' => 'The end date must be equal to or after the start date.',
            'category.required' => 'The category is required.',
            'category.in' => 'The category must be' . implode(', ', [CategoryConstants::EXPENSE, CategoryConstants::INCOME]),
        ];
    }
}
