<?php

namespace Modules\Account\Http\Requests\User\Phone;

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
            'number'     => 'required|numeric|unique:user_phones,number,'.auth()->id().',user_id',
            'whatsapp'   => 'boolean'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes()
    {
        return [
            'number' => 'nomor HP',
        ];
    }
}