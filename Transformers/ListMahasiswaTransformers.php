<?php

namespace Modules\Mahasiswa\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ListMahasiswaTransformers extends Resource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "nama" => $this->nama,
            "nim" => $this->nim,
            "jurusan" => $this->jurusan,
            "email" => $this->email,
            "created_at" => $this->created_at,
            "urls" => [
                "delete_url" => route("mahasiswa.mahasiswas.destroy", ["mahasiswa" => $this->id])
            ]
        ];
    }
}
