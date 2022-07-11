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
        <section class="invoice">

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr style="text-align:left">
                                <th>ID</th>
                                <th>Tên Minh Chứng</th>
                                <th>Nơi Ban Hành</th>
                                <th>Ngày Ban Hành</th>
                                <th>Mã minh chứng</th>
                                <th>Đơn vị báo cáo</th>
                                <!-- <th>Tiêu chí</th>
                                <th>Tiêu chuẩn</th> -->
                                <th class="col-2 col-sm-3">Nội Dung</th>
                                <th colspan="3">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->ten_minh_chung }}</td>
                                    <td>{{ $row->dia_diem_phat_hanh }}</td>
                                    <td>{{ $row->ngay_phat_hanh }}</td>
                                    <td>{{ $row->ma_minh_chung }}</td>
                                    <td>{{ $row->dvbc }}</td>
                                    
                                    <td>{{ $row->noi_dung }}</td>

                                    <td>
                                        <a href="{{ url('/uploads') }}/{{ $row->hash_file }}"
                                            class="glyphicon glyphicon-download" download="{{ $row->file }}"></a>
                                    </td>

                                    <td>
                                        <a href="{{ url('/suaminhchungcsgd') }}/{{ $row->id }}"
                                            class="glyphicon glyphicon-edit"></a>
                                    </td>

                                    <td> <a href="{{ url('/xoaminhchungcsgd') }}/{{ $row->id }}"
                                            onclick="return  confirm(' Bạn có chắc muốn xóa minh chứng này chứ!')"
                                            class="glyphicon glyphicon-remove"></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
@stop
