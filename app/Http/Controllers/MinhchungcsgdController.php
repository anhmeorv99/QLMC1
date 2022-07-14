<?php

namespace App\Http\Controllers;
use App\Minhchungcsgd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;

class MinhchungcsgdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $query = DB::table("minhchung");
        $query = $query->select('minhchung.*', 'dvbc.id as dvbc')
        ->leftJoin('dvbc', function($leftJoin)
        {
            $leftJoin->on('minhchung.id_dvbc', '=', 'dvbc.id');
        })->where('minhchung.kieu_minh_chung', '=', 'csgd')
        ->orderby("minhchung.id", "ASC");

        $data = $query->paginate(50);
        return view('/minhchungcsgd/minhchungcsgd',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->isMethod('post')){
            $tenminhchung = $request->input("tenminhchung");
            $noibanhanh = $request->input("noibanhanh");
            $ngaybanhanh = $request->input("ngaybanhanh");
            $sohieu = $request->input("sohieu");
            $tentieuchuan = $request->input("tentieuchuan");
            $tentieuchi = $request->input("tentieuchi");
            $tencap = $request->input("tencap");
            $noidung = $request->input("noidung");
            if ($files = $request->file('file')) {
                $hash = md5_file($files->path());
                // store file into document folder
                $custom_file_name = $request->file('file')->getClientOriginalName();
                $extension = $request->file('file')->getClientOriginalExtension();
                $file_name = $hash . '.' . $extension;

                $request->file('file')->storeAs('uploads', $file_name);
                $request->file('file')->move(public_path('/uploads'), $file_name);

                $minhchung = new Minhchungcsgd();
                $minhchung->tenminhchung=$tenminhchung;
                $minhchung->noibanhanh=$noibanhanh;
                $minhchung->ngaybanhanh=$ngaybanhanh;
                $minhchung->sohieu=$sohieu;
                $minhchung->tentieuchuan=$tentieuchuan;
                $minhchung->tentieuchi=$tentieuchi;
                $minhchung->tencap=$tencap;
                $minhchung->noidung=$noidung;
                $minhchung->file=$custom_file_name;
                $minhchung->hash_file=$file_name;
                $minhchung->save();

                }



            return Redirect::to("/minhchungcsgd");
        }

        $dvbc = \Auth::user()->id_dvbc;
        return view('/minhchungcsgd/themminhchungcsgd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $query = DB::table("minhchungcsgds");
        $query = $query->orderby("id", "DESC");
        $query = $query->select("*");
        $data = $query->paginate(50);
    //    $tieuchuans = DB::table('tieuchuans')->get();
        return view('/minhchungcsgd/chonminhchungcsgd',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $data_view = array();
        $minhchung = Minhchungcsgd::find($id);
        $data_view["minhchung"] = $minhchung;
        if($request->isMethod('post')){
            $tenminhchung = $request->input("tenminhchung");
            $noibanhanh = $request->input("noibanhanh");
            $ngaybanhanh = $request->input("ngaybanhanh");
            $sohieu = $request->input("sohieu");
            $tentieuchuan = $request->input("tentieuchuan");
            $tentieuchi = $request->input("tentieuchi");
            $tencap = $request->input("tencap");
            $noidung = $request->input("noidung");
            if ($files = $request->file('file')) {
                $hash = md5_file($files->path());
                // store file into document folder
                $custom_file_name = $request->file('file')->getClientOriginalName();
                $extension = $request->file('file')->getClientOriginalExtension();
                $file_name = $hash . '.' . $extension;

                $request->file('file')->storeAs('uploads', $file_name);
                $request->file('file')->move(public_path('/uploads'), $file_name);

                // $minhchung = new Minhchungcsgd();
                $minhchung->tenminhchung=$tenminhchung;
                $minhchung->noibanhanh=$noibanhanh;
                $minhchung->ngaybanhanh=$ngaybanhanh;
                $minhchung->sohieu=$sohieu;
                $minhchung->tentieuchuan=$tentieuchuan;
                $minhchung->tentieuchi=$tentieuchi;
                $minhchung->tencap=$tencap;
                $minhchung->noidung=$noidung;
                $minhchung->file=$custom_file_name;
                $minhchung->hash_file=$file_name;
                $minhchung->save();

                }

            return Redirect::to("/minhchungcsgd");
        }
        return view('minhchungcsgd/suaminhchungcsgd',$data_view);

    }
    public function delete($id)
    {
        $minhchungDelete = Minhchungcsgd::find($id);
        $minhchungDelete->delete();

        return redirect('/minhchungcsgd');
        alert('Đã xóa thành công minh chứng');
    }
    public function search(Request $request)
    {
        $query = DB::table("minhchungcsgds");
        if($request->isMethod('post')){
            $tenminhchung = $request->input("tenminhchung");
            $tentieuchuan = $request->input("tentieuchuan");
            $tentieuchi = $request->input("tentieuchi");
            $sohieu = $request->input("sohieu");
            $query = $query ->where('tenminhchung', 'like', '%' .  $tenminhchung . '%')->where('sohieu', 'like', '%' .  $sohieu . '%')
                            ->where('tentieuchuan', 'like', '%' .  $tentieuchuan . '%')->where('tentieuchi', 'like', '%' .  $tentieuchi . '%');


        }
        $data =  $query->orderby("id")->select("*") -> get();
        return view('/minhchungcsgd/timminhchungcsgd') -> with("data",$data);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
