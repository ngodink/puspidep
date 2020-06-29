<?php

namespace Modules\Account\Http\Requests\User\Email;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return auth()->user()->can('update', auth()->user());
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'email'     => 'required|email|max:191|unique:user_emails,address,'.auth()->id().',user_id',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes()
    {
        return [
            'email' => 'alamat e-mail',
        ];
    }
}