<?php
namespace App\Http\Controllers;
use App\Models\MinhChung;
use Illuminate\Http\Request;
use DataTables;
use DB;
class EmpController extends Controller
{
    //
    public function index()
    {
        return view('listing');
    }
    public function getEmployees(Request $request)
    {
        $data = DB::table("minhchung")->select("*")->orderby("id", "ASC");
        // echo json_encode($data);
        if ($request->ajax()) {
           
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<div class="col-md-12 text-center"><a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> 
                    <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>
                    <a href="javascript:void(0)" class="download btn btn-primary btn-sm">Download</a></div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}