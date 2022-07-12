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
                    $link = "https://upload.wikimedia.org/wikipedia/commons/0/06/Tr%C3%BAc_Anh_%E2%80%93_M%E1%BA%AFt_bi%E1%BA%BFc_BTS_%282%29.png";
                    $is_pdf = '<embed src="https://iq.opengenus.org/resume/0924.pdf"
                                type="application/pdf" style="height: 700px;width: -webkit-fill-available"/>';
                     
                    $actionBtn ='<div class="text-center">
                    
                    
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModalCenter">
                        <i class="bi bi-eye-fill"></i>
                    </button>
                    <a href="javascript:void(0)" class="edit btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a> 
                    <a href="javascript:void(0)" class="edit btn btn-danger btn-sm"><i class="bi bi-trash3"></i></a>
                    

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:80%; width:65%">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" >
                            ' . $is_pdf . '

                            </div>
                        
                            </div>
                        </div>
                        </div>
                    </div>'; 
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}