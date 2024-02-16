<?php

namespace App\Http\Requests;


class GetAllFinanceEntriesRequest extends BaseApiRequest
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
    // TODO: sort data by category
    public function rules()
    {
        return [
            'date' => 'sometimes|required|date',
            // 'category' => 'sometime|in:expense,income',
            'per_page' => 'sometimes|required|integer|min:1',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'date.date' => 'The date filter must be a valid date.',
            // 'category.string' => 'Provided category must income or expense, keep empty to get both data',
            // 'category.max' => 'The category may not be greater than 255 characters.',
            'per_page.integer' => 'The per_page parameter must be an integer.',
            'per_page.min' => 'The per_page parameter must be at least 1.',
        ];
    }
}
