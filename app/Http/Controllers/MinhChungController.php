<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\TieuChuan;
use App\Models\MinhChung;
use App\Models\TieuChi;
use App\Models\CTDT;
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
        $where=[];
        $where['id_tieu_chi']=$id;
        if(\Auth::guard('user')->check()){
            $where['id_dvbc']=\Auth::user()->id_dvbc;
        }
        $list = MinhChung::where($where)->get();
        $tieuChi = TieuChi::find($id);
        $data['list']=$list;
        $data['tieuChi']=$tieuChi;
        \Cache::put('id_tieu_chi', $id, 60*60*24);
        return view('minhchung.list', $data);
    }

    public function showCreateMinhChung()
    {
        $data =[];
        $id_tieu_chi = \Cache::get('id_tieu_chi');
        $tieuChi = TieuChi::find($id_tieu_chi);
        $data['tieuChi']=$tieuChi;
        $tieuChuan = TieuChuan::find($tieuChi->id_tieu_chuan);
        $data['tieuChuan']=$tieuChuan;
        if($tieuChuan->loai_tieu_chuan == "CTDT"){
            $data['ctdt'] = CTDT::where("id_dvbc", \Auth::guard('user')->user()->id_dvbc)->get();
        }
        $data["routeAction"] = route('minhchung.create-minh-chung');
        return view('minhchung.detail', $data);
    }

    public function create(Request $request)
    {
        if($request->isMethod('post')){
            $name = $request->input("name");
            $content = $request->input("content");
            $id_dvbc = \Auth::guard('user')->user()->id_dvbc;
            $id_ctdt = $request->ctdt;
            $id_tieuchi = $request->id_tieuchi;
            if ($files = $request->file('file')) {
                $hash = md5_file($files->path());
                // store file into document folder
                $custom_file_name = $request->file('file')->getClientOriginalName();
                $extension = $request->file('file')->getClientOriginalExtension();
                $file_name = $hash . '.' . $extension;

                $request->file('file')->storeAs('uploads', $file_name);
                $request->file('file')->move(public_path('/uploads'), $file_name);


                $minhchung = MinhChung::create([
                    'ten_minh_chung' => $name,
                    'noi_dung' => $content,
                    'id_dvbc' => $id_dvbc,
                    'id_ctdt' => $id_ctdt,
                    'id_tieu_chi' => $id_tieuchi,
                    'file' => $custom_file_name,
                    'hash_file' => $file_name,
                    'duyet' => 'ACCEPTED',
                ]);

            return redirect()->route('minhchung.showListMinhChung', ['id' => $id_tieuchi]);

            }
            return redirect()->back()->with('error', 'File không hợp lệ');
        }
    }

    public function showEditMinhChung($id)
    {
        $data = [];
        $minhchung = MinhChung::find($id);
        $data['minhchung']=$minhchung;
        $tieuChi = TieuChi::find($minhchung->id_tieu_chi);
        $data['tieuChi']=$tieuChi;
        $tieuChuan = TieuChuan::find($tieuChi->id_tieu_chuan);
        $data['tieuChuan']=$tieuChuan;
        if($tieuChuan->loai_tieu_chuan == "CTDT"){
            $data['ctdt'] = CTDT::where("id_dvbc", \Auth::guard('user')->user()->id_dvbc)->get();
        }
        $data["routeAction"] = route('minhchung.edit-minh-chung');

        return view('minhchung.detail', $data);
    }

    public function edit(Request $request)
    {
        if($request->isMethod('post')){
            $name = $request->input("name");
            $content = $request->input("content");
            $id_dvbc = \Auth::guard('user')->user()->id_dvbc;
            $id_ctdt = $request->ctdt;
            $id_tieuchi = $request->id_tieuchi;
            if ($files = $request->file('file')) {
                $hash = md5_file($files->path());
                // store file into document folder
                $custom_file_name = $request->file('file')->getClientOriginalName();
                $extension = $request->file('file')->getClientOriginalExtension();
                $file_name = $hash . '.' . $extension;

                $request->file('file')->storeAs('uploads', $file_name);
                $request->file('file')->move(public_path('/uploads'), $file_name);



                MinhChung::where("id", $request->input('id'))->update([
                    'ten_minh_chung' => $name,
                    'noi_dung' => $content,
                    'id_dvbc' => $id_dvbc,
                    'id_ctdt' => $id_ctdt,
                    'id_tieu_chi' => $id_tieuchi,
                    'file' => $custom_file_name,
                    'hash_file' => $file_name,
                    'duyet' => 'ACCEPTED',
                ]);

            return redirect()->route('minhchung.showListMinhChung', ['id' => $id_tieuchi]);

            }
            return redirect()->back()->with('error', 'File không hợp lệ');
        }
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
