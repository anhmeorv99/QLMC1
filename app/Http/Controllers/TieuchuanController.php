<?php

namespace App\Http\Controllers;

use App\Models\TieuChuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use DB;

class TieuChuanController extends Controller
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
        $data = [];
        $list = TieuChuan::orderby("id", "asc")->get();
        $data['list'] = $list;
        return view('tieuchuan.tieuchuan', $data);
    }

    public function delete(Request $request)
    {
        $tieuChuanDelete = TieuChuan::find($request->id);
        $tieuChuanDelete->delete();

        return new JsonResponse(['status' => 'success', 'message' => 'Đã xóa thành công tiêu chuẩn'], 200);
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255|in:CSGD,CTDT',
        ]);
        if ($validator->fails()) {
            return new JsonResponse(['errors' => $validator->getMessageBag()->toArray()], 406);
        } else {
            $tieuchuan = TieuChuan::create([
                'ten_tieu_chuan' => trim($request->input('name')),
                'loai_tieu_chuan' => trim($request['type']),
                'noi_dung' => trim($request->input('content')),
            ]);
            return new JsonResponse($tieuchuan, 200);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255|in:CSGD,CTDT',
            'id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return new JsonResponse(['errors' => $validator->getMessageBag()->toArray()], 406);
        } else {
            $tieuchuan = TieuChuan::find($request->input('id'));

            $tieuchuan->ten_tieu_chuan = trim($request->input('name'));
            $tieuchuan->loai_tieu_chuan = trim($request->input('type'));
            $tieuchuan->noi_dung = trim($request->input('content'));
            $tieuchuan->save();
            return new JsonResponse($tieuchuan, 200);
        }
    }
}
