@extends('layouts.dash')
@section('section')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header d-flex justify-content-between px-5">
            <h1>
                {{ $tieuChi->ten_tieu_chi}}
            </h1>
            <a href="#" class="btn btn-primary" style="margin-right: 15px;"> <i class="bi bi-person-plus-fill"></i></a>
        </section>

        <!-- Main content -->
        <!-- <section class="invoice"> -->

        <div class="mt-5" style="width: 95%; margin: auto">
            <table class="table table-bordered yajra-datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên MC</th>
                        <th>Kiểu MC</th>
                        <th>Nội Dung</th>
                        <th>File</th>
                        <th style="width:15%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr id="row_{{$item->id}}">
                            <td class="sorting_1">{{$item->id}}</td>
                            <td>{{$item->ten_minh_chung}}</td>
                            <td>{{$item->kieu_minh_chung}}</td>
                            <td>{{$item->noi_dung}}</td>
                            <td>{{$item->file}}</td>
                            <td>
                                <div class="text-center">
                                    <button type="button" class="btn btn-link" data-toggle="modal"
                                        data-target="#exampleModalCenter">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <a href="javascript:void(0)" class="edit btn btn-primary btn-sm"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="javascript:void(0)" class="edit btn btn-danger btn-sm"><i
                                            class="bi bi-trash3"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:80%; width:65%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <embed src="https://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf" type="application/pdf"
                        style="height: 700px;width: -webkit-fill-available">

                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {

            var table = $('.yajra-datatable').DataTable();
        });
    </script>
@stop
