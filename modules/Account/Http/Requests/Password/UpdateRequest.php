<?php

namespace Modules\Account\Http\Requests\Password;

use Modules\Account\Rules\OldPassword;
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
            'old_password'  => ['required', new OldPassword],
            'password'      => 'required|string|min:4|max:191|confirmed'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes()
    {
        return [
            'old_password' => 'sandi lama',
            'password' => 'sandi',
        ];
    }
}