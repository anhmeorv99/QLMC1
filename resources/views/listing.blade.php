@extends('layouts.dash')
@section('section')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header d-flex justify-content-between px-5">
            <h1>
                Danh Sách Minh Chứng CSGD
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
                            <th style="width:100px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        <!-- </section> -->
        <!-- /.content -->
        <div class="clearfix"></div>

    </div>

    
<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('emp.listing') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'ten_minh_chung', name: 'ten_minh_chung'},
            {data: 'kieu_minh_chung', name: 'kieu_minh_chung'},
            {data: 'noi_dung', name: 'noi_dung'},
            {data: 'file', name: 'file'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
    
  });
</script>
@stop
