<?php

namespace App\Http\Requests;

use App\Helpers\Currency;
use App\Rules\CurrencyRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateIncomeRequest extends FormRequest
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
            'amount' => (new Currency($this->amount))->toFloat(),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'       => 'required|string|max:255',
            'amount'      => ['required', new CurrencyRule()],
            'date'        => 'required|date',
            'description' => 'nullable|string|max:255',
        ];
    }
}
