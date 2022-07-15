<?php

namespace App\Http\Controllers;

use App\Models\TieuChi;
use App\Models\TieuChuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use DB;

class TieuChiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $list = TieuChi::with('tieuchuan')->orderby("id", "asc")->get();
        $listTieuChuan = TieuChuan::orderby("id", "asc")->get();


        return view('tieuchi.tieuchi', compact(['list', 'listTieuChuan']));
    }

    public function delete(Request $request)
    {
        $tieuChiDelete = TieuChi::find($request->id);
        $tieuChiDelete->delete();

        return new JsonResponse(['status' => 'success', 'message' => 'Đã xóa thành công tiêu chí'], 200);
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'tieuchuan' => 'required|integer',
        ]);
        $tieuchuanRecord = TieuChuan::where('id', $request['tieuchuan'])->get();
        if ($validator->fails()) {
            return new JsonResponse(['errors' => $validator->getMessageBag()->toArray()], 406);
        } else {
            $tieuchi = TieuChi::create([
                'ten_tieu_chi' => trim($request->input('name')),
                'id_tieu_chuan' => trim($request['tieuchuan']),
                'noi_dung' => trim($request->input('content')),
            ]);

            return response()->json(['tieuchi'=>$tieuchi,'ten_tieu_chuan'=>$tieuchuanRecord[0]['ten_tieu_chuan']]);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'tieuchuan' => 'required|integer',
            'id' => 'required|integer',
        ]);
        $tieuchuanRecord = TieuChuan::where('id', $request['tieuchuan'])->get();
        if ($validator->fails()) {
            return new JsonResponse(['errors' => $validator->getMessageBag()->toArray()], 406);
        } else {
            $tieuchi = TieuChi::find($request->input('id'));

            $tieuchi->ten_tieu_chi = trim($request->input('name'));
            $tieuchi->noi_dung = trim($request->input('content'));
            $tieuchi->id_tieu_chuan = trim($request['tieuchuan']);

            $tieuchi->save();
            return response()->json(['tieuchi'=>$tieuchi,'ten_tieu_chuan'=>$tieuchuanRecord[0]['ten_tieu_chuan']]);
        }
    }
}
