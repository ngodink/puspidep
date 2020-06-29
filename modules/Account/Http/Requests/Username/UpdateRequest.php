<?php

namespace Modules\Account\Http\Requests\Username;

use Illuminate\Foundation\Http\FormRequest;

use Modules\Account\Models\User;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return auth()->user()->can('updateUsername', User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'username'          => 'required|min:4|max:191|regex:/^[a-z\d.]{4,20}$/|unique:users,username,'.auth()->id(),
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function messages()
    {
        return [
            'username.unique' => 'Isian :attribute sudah digunakan oleh orang lain, silahkan gunakan :attribute lainnya.'
        ];
    }
}