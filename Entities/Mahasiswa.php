<?php

namespace Modules\Mahasiswa\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class Mahasiswa extends Model
{
    use Translatable;

    protected $table = 'mahasiswa__mahasiswas';
    public $translatedAttributes = [];
    protected $fillable = [
        "nama",
        "jurusan",
        "email",
        "nim",
    ];

    public function serverPaginationFilteringFor(Request $request): LengthAwarePaginator
    {
        $data = $this->select("*");

        if ($request->search) {
            $search = "%$request->search%";
            $data = $data->where(function ($query) use ($search) {
                $query->where("nim", "like", $search)
                    ->orWhere("jurusan", "like", $search)
                    ->orWhere("email", "like", $search)
                    ->orWhere("email", "like", $search)
                    ->orWhere("nama", "like", $search);
            });
        }

        $order = $request->get("order", "ascending") == "ascending" ? "asc" : "desc";
        if ($request->order_by) $data = $data->orderBy($request->get("order_by", "created_at"), $order);

        return $data->paginate($request->get("per_page", 10));
    }
}
