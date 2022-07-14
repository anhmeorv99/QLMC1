<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\TieuChuan;
use App\Models\MinhChung;
use App\Models\TieuChi;
class MinhChungController extends Controller
{
    public function showCategory()
    {
        $data = [];
        $list = TieuChuan::all();
        $data['list']=$list;
        return view('minhchung.category', $data);
    }

    public function showListMinhChung($id)
    {
        $data = [];
        $list = MinhChung::where('id_tieu_chi', $id)->get();
        $tieuChi = TieuChi::find($id);
        $data['list']=$list;
        $data['tieuChi']=$tieuChi;
        return view('minhchung.list', $data);
    }

    public function showMinhChung($id)
    {
        $minhChung = MinhChung::find($id);

    }

    public function getTieuChi($id)
    {
        $list = TieuChi::where('id_tieu_chuan', $id)->get();
        return new JSONResponse($list, 200);
    }
}
