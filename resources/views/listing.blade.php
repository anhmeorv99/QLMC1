@extends('layouts.dash')
@section('section')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh Sách Minh Chứng CSGD
            </h1>

        </section>
         
        <!-- Main content -->
        <!-- <section class="invoice"> -->

        <div class="container-xl mt-5">
                <table class="table table-bordered yajra-datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên MC</th>
                            <th>Kiểu MC</th>
                            <th>Nội Dung</th>
                            <th>Action</th>
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
