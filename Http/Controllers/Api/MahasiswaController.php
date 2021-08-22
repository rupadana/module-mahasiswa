<?php

namespace Modules\Mahasiswa\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Mahasiswa\Entities\Mahasiswa;
use Modules\Mahasiswa\Http\Requests\CreateMahasiswaRequest;
use Modules\Mahasiswa\Http\Requests\UpdateMahasiswaRequest;
use Modules\Mahasiswa\Repositories\MahasiswaRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Mahasiswa\Transformers\FullMahasiswaTransformers;
use Modules\Mahasiswa\Transformers\ListMahasiswaTransformers;

class MahasiswaController extends AdminBaseController
{
    protected $mahasiswa;
    public function __construct()
    {
        $this->mahasiswa = new Mahasiswa();
    }
    public function index(Request $request)
    {

        return ListMahasiswaTransformers::collection($this->mahasiswa->serverPaginationFilteringFor($request));
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return response()->json([
            "errors" => false,
            "message" => trans('mahasiswa::mahasiswas.messages.mahasiswa deleted')
        ]);
    }

    public function create(CreateMahasiswaRequest $request)
    {
        Mahasiswa::create($request->all());

        return response()->json([
            "errors" => false,
            "message" => trans('mahasiswa::mahasiswas.messages.mahasiswa created')
        ]);
    }

    public function update(Mahasiswa $mahasiswa, UpdateMahasiswaRequest $request)
    {

        $mahasiswa->fill($request->all());

        $mahasiswa->save();

        return response()->json([
            "errors" => false,
            "message" => trans('mahasiswa::mahasiswas.messages.mahasiswa updated')
        ]);
    }

    public function find(Mahasiswa $mahasiswa)
    {

        return new FullMahasiswaTransformers($mahasiswa);
    }
}
