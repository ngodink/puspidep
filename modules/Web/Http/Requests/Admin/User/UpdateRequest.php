<?php

namespace Modules\Web\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        // return auth()->user()->can('update', auth()->user());
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:191',
            'username' => 'required|string|min:4|max:191|regex:/^[a-z\d.]{4,20}$/|unique:users,id,'.$this->user->id,
            'bio' => 'nullable',
            'roles.*' => 'required|exists:roles,id'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes()
    {
        return [
            'name' => 'nama lengkap',
            'username' => 'username',
            'bio' => 'bio',
        ];
    }
}