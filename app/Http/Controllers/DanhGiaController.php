<?php

namespace App\Http\Controllers;

use App\Models\DanhGia;
use App\Models\TieuChi;
use App\Models\TieuChuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DanhGiaController extends Controller
{
    public function showDanhGia(Request $request)
    {
        $data = [];
        $tieuChuan = TieuChuan::all();
        if(Auth::guard('user')->check()){
            $year = date('Y');
            $id_dvbc = Auth::guard('user')->user()->id_dvbc;
        } else {
            $year = $request->has('year')?$request->year:date('Y');
            $id_dvbc = $request->dvbc;
        }
        $check = DanhGia::where('id_dvbc', $id_dvbc)->where('year', $year)->get();
        // dd($check);
        if (sizeof($check) == 0) {
            $tieuChi = TieuChi::all();
            foreach ($tieuChi as $key => $value) {
                $new = new DanhGia();
                $new->id_dvbc=$id_dvbc;
                $new->id_tieu_chi=$value->id;
                $new->tu_danh_gia=0;
                $new->year=$year;
                $new->save();
            }
        }
        $tieuChi = DanhGia::where('id_dvbc', $id_dvbc)->where('year', $year)
                            ->join('tieuchi', 'tieuchi.id', 'danhgia.id_tieu_chi')
                            ->select("tieuchi.id", "tieuchi.ten_tieu_chi", "tieuchi.id_tieu_chuan","danhgia.id as id_danh_gia", "danhgia.danh_gia", "danhgia.tu_danh_gia", 'danhgia.year', "danhgia.id_dvbc")->get();
        // $tieuChi = TieuChi::join('danhgia', 'danhgia.id_tieu_chi', "tieuchi.id")
        //             ->select("tieuchi.id", "tieuchi.ten_tieu_chi", );
        // dd($tieuChi);
        $data["year"] = DanhGia::distinct('year')->pluck('year')->toArray();
        $data['yearCurrent']= $year;
        $data['tieuChuan'] = $tieuChuan;
        $data['tieuChi'] = $tieuChi;
        // dd($tieuChuan);
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
