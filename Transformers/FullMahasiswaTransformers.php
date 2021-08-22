<?php

namespace Modules\Mahasiswa\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class FullMahasiswaTransformers extends Resource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "nama" => $this->nama,
            "nim" => $this->nim,
            "jurusan" => $this->jurusan,
            "email" => $this->email,
        ];
    }
}
