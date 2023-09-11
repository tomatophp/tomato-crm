<?php

namespace TomatoPHP\TomatoCrm\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class AccountUpdateRequest extends FormRequest
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
            'name' => 'nullable|max:255|string',
            'username' => 'sometimes|max:255|string',
            'loginBy' => 'nullable|max:255|string',
            'address' => 'nullable|max:65535',
            'password' => 'nullable|max:255|confirmed|min:6',
            'otp_code' => 'nullable|max:255|string',
            'last_login' => 'nullable',
            'agent' => 'nullable',
            'host' => 'nullable|max:255|string',
            'is_login' => 'nullable',
            'is_active' => 'nullable'
        ];
    }
}
