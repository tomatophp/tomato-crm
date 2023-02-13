<?php

namespace TomatoPHP\TomatoCrm\Http\Requests\Activity;

use Illuminate\Foundation\Http\FormRequest;

class ActivityUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
                        'account_id' => 'sometimes|exists:accounts,id',
            'type' => 'nullable|max:255|string',
            'log' => 'sometimes'
        ];
    }
}
