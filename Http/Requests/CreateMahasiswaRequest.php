<?php

namespace Modules\Mahasiswa\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateMahasiswaRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'nama' => 'required',
            'jurusan' => 'required',
            'nim' => 'required',
            'email' => 'required|email',
        ];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
