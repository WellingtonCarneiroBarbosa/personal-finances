<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseUpdateRequest extends FormRequest
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
            'title'               => ['required', 'max:255', 'string'],
            'cost'                => ['required', 'regex:/^\d{1,13}(\.\d{1,4})?$/'],
            'description'         => ['nullable', 'max:255', 'string'],
            'expense_category_id' => [
                'required',
                'exists:expense_categories,id',
            ],
            'workspace_id' => ['required', 'exists:workspaces,id'],
        ];
    }
}
