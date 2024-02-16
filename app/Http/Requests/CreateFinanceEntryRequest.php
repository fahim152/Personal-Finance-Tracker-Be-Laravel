<?php

namespace App\Http\Requests;

use App\Constants\CategoryConstants;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use ReflectionClass;

class CreateFinanceEntryRequest extends BaseApiRequest
{
    private $categories;
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $reflection = new ReflectionClass(CategoryConstants::class);
        $this->categories = implode(',', $reflection->getConstants());

        return [
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'category' => 'required|in:' . $this->categories,
            'description' => 'nullable|string',
        ];
    }
    public function messages()
    {
        return [
            'category.in' => 'The category must be ' . $this->categories,
        ];
    }
}
