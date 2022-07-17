<?php

namespace App\Http\Controllers;

use App\Models\CTDT;
use App\Models\DanhGia;
use App\Models\DVBC;
use App\Models\TieuChi;
use App\Models\TieuChuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DanhGiaController extends Controller
{
    public function showCTDT()
    {
        if(Auth::guard('user')->check()){
        } else{
            $dvbc = DVBC::all();
            $ctdt = CTDT:: all();
            $data = [];
            $data['dvbc']= $dvbc;
            $data['ctdt'] = $ctdt;
            return view('danhgia.list', $data);
        }

    }
    public function showDanhGia(Request $request)
    {
        $data = [];
        if(!$request->has('category')){
            return abort(404);
        }
        $tieuChuan = TieuChuan::where("loai_tieu_chuan", $request->category)->get();
        $idTieuChuan = $tieuChuan->pluck("id")->toArray();
        $tieuChi = TieuChi::whereIn("id_tieu_chuan", $idTieuChuan)->get();
        $idTieuChi = $tieuChi->pluck("id")->toArray();

        // dd($idTieuChi);

        if(Auth::guard('user')->check()){
            $year = date('Y');
            $id_dvbc = Auth::guard('user')->user()->id_dvbc;
        } else {
            $year = $request->has('year')?$request->year:date('Y');
            if(!$request->has('dvbc')){
                return abort(404);
            }
            $id_dvbc = $request->dvbc;
        }
        $dvbc = DVBC::find($id_dvbc);
        $check = DanhGia::where('id_dvbc', $id_dvbc)->where('year', $year)->whereIn("id_tieu_chi", $idTieuChi)->get();
        // dd($check);
        if (sizeof($check) == 0) {
            foreach ($tieuChi as $key => $value) {
                $new = new DanhGia();
                $new->id_dvbc=$id_dvbc;
                $new->id_tieu_chi=$value->id;
                $new->tu_danh_gia=0;
                $new->year=$year;
                $new->save();
            }
        }
        $tieuChi = DanhGia::where('id_dvbc', $id_dvbc)->where('year', $year)->whereIn("id_tieu_chi", $idTieuChi)
                            ->join('tieuchi', 'tieuchi.id', 'danhgia.id_tieu_chi')
                            ->select("tieuchi.id", "tieuchi.ten_tieu_chi", "tieuchi.id_tieu_chuan","danhgia.id as id_danh_gia", "danhgia.danh_gia", "danhgia.tu_danh_gia", 'danhgia.year', "danhgia.id_dvbc")->get();
        // $tieuChi = TieuChi::join('danhgia', 'danhgia.id_tieu_chi', "tieuchi.id")
        //             ->select("tieuchi.id", "tieuchi.ten_tieu_chi", );
        // dd($tieuChi);
        $data["year"] = DanhGia::where('id_dvbc', $id_dvbc)->whereIn("id_tieu_chi", $idTieuChi)->distinct('year')->pluck('year')->toArray();
        $data['yearCurrent']= $year;
        $data['tieuChuan'] = $tieuChuan;
        $data['tieuChi'] = $tieuChi;
        // dd($tieuChuan);
        $data["category"]=$request->category;
        $data["dvbc"]= $dvbc;
        return view('danhgia.tudanhgia', $data);
    }

    public function saveDanhGia(Request $request)
    {
        // $danhgia = DanhGia::where('id_dvbc', $request->id_dvbc)->where('year', $request->year)->get();
        $data = json_decode($request->data);

        if($request->type_user == "user"){
            foreach($data as $item){
                DanhGia::where('id', $item->id)->update([
                    'tu_danh_gia'=> $item->value
                ]);
            }
        }
        if($request->type_user == "admin"){
            foreach($data as $item){
                DanhGia::where('id', $item->id)->update([
                    'danh_gia'=> $item->value
                ]);
            }
        }
    }
}
