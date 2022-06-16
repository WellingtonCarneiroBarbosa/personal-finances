<?php

namespace App\Http\Requests;

use App\Helpers\Currency;
use App\Rules\CurrencyRule;
use Illuminate\Foundation\Http\FormRequest;

class ExpenseStoreRequest extends FormRequest
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

    public function prepareForValidation()
    {
        $this->merge([
            'cost' => (new Currency($this->cost))->toFloat(),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'               => ['required', 'max:255', 'string'],
            'cost'                => ['required', new CurrencyRule()],
            'description'         => ['nullable', 'max:255', 'string'],
            'date'                => ['required', 'date'],
            'expense_category_id' => ['exists:expense_categories,id',],
        ];
    }
}
