@extends('layouts.dash')

@section('section')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header d-flex justify-content-between px-5">
      <h1>
        Danh Sách Người Dùng
      </h1>
      <a href="#" class="btn btn-primary"> <i class="bi bi-person-plus-fill"></i></a>

    </section>

    <!-- Main content -->
    <section class="invoice">

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>ID</th>
              <th>Tên Người Dùng</th>
              <th>Tên tài khoản</th>
              <th>Email</th>
              <th>Xóa</th>
            </tr>
            </thead>
            <tbody>
              @foreach($data as $row)
              <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->username}}</td>
                <td>{{$row->email}}</td>
        
                <td>  <a href="{{ url('/delete-hddg')}}/{{$row->id}}" onclick="return  confirm(' Bạn có chắc muốn xóa user này chứ!')" class="glyphicon glyphicon-remove">Xóa</a>
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
@endsection
