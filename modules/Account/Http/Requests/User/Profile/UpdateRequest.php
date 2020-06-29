<?php

namespace Modules\Account\Http\Requests\User\Profile;

use Modules\Account\Models\UserProfile;
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
            'name'          => 'required|string|max:191',
            'prefix'        => 'nullable|string|max:50',
            'suffix'        => 'nullable|string|max:50',
            'pob'           => 'required|string|max:191',
            'dob'           => 'required|string|date_format:d-m-Y',
            'sex'           => 'required|in:'.join(',', array_keys(UserProfile::$sex)),
            'blood'         => 'nullable|in:'.join(',', array_keys(UserProfile::$blood)),
            'nik'           => 'required|numeric',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes()
    {
        return [
            'prefix' => 'gelar depan',
            'name' => 'nama lengkap',
            'suffix' => 'gelar belakang',
            'pob' => 'tempat lahir',
            'dob' => 'tanggal lahir',
            'sex' => 'jenis kelamin',
            'blood' => 'golongan darah',
            'nik' => 'NIK',
        ];
    }
}
