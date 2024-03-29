<?php

namespace TomatoPHP\TomatoCrm\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class ContactStoreRequest extends FormRequest
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
            'type_id' => 'required|exists:types,id',
            'status_id' => 'required|exists:types,id',
            'name' => 'required|max:255|string',
            'email' => 'nullable|max:255|string|email',
            'phone' => 'nullable|max:255|min:12',
            'subject' => 'required|max:255|string',
            'message' => 'required|max:65535',
            'active' => 'nullable'
        ];
    }
}
