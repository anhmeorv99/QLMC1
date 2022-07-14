<?php

namespace App\Http\Controllers;

use App\Models\TieuChi as ModelsTieuChi;
use App\Tieuchi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use DB;

class TieuchiController extends Controller
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
        $list = ModelsTieuChi::orderby("id", "asc")->get();
        $data['list'] = $list;
        return view('tieuchi.tieuchi', $data);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $tentieuchi = $request->input("tentieuchi");
            $cap_id = $request->input("cap_id");
            $tieuchi = new Tieuchi();
            $tieuchi->cap_id = $cap_id;
            $tieuchi->tentieuchi = $tentieuchi;
            $tieuchi->save();
            return Redirect::to("/tieuchi");
        }
        return view('/tieuchi/themtieuchi');
    }

    public function delete(Request $request)
    {
        $tieuChiDelete = ModelsTieuChi::find($request->id);
        $tieuChiDelete->delete();

        // return redirect('/users-hddg');
        // alert('Đã xóa thành công minh chứng');
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
            $tieuchi = ModelsTieuChi::create([
                'ten_tieu_chuan' => trim($request->input('name')),
                'loai_tieu_chuan' => trim($request['type']),
                'noi_dung' => trim($request->input('content')),
            ]);
            return new JsonResponse($tieuchi, 200);
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
            $tieuchi = ModelsTieuChi::find($request->input('id'));

            $tieuchi->ten_tieu_chuan = trim($request->input('name'));
            $tieuchi->loai_tieu_chuan = trim($request->input('type'));
            $tieuchi->noi_dung = trim($request->input('content'));
            $tieuchi->save();
            return new JsonResponse($tieuchi, 200);
        }
    }
}
