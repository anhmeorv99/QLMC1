@extends('layouts.dash')

@section('section')



  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Trang Chủ Quản Lý Minh Chứng 
      </h1>
    </section>
        <section class="content">
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Sinh viên thực hiện:</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>STT</th>
                  <th>Họ và tên</th>
                  <th>Mã sinh viên</th>
                  <th>Email</th>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Tạ Duy Tiến</td>
                  <td>20209050</td>
                  <td>Tien.TD202010450@husteduvn.onmicrosoft.com</td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Công Việc Hoàn Thành:</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Công Việc</th>
                  <th>Tiến Độ</th>
                  <th style="width: 100px">Hoàn thành</th>
                </tr>
                <tr>
                  <td>1.</td>
                  <td>Giao diện</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-red">100%</span></td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>Tạo database</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-primary" style="width: 95%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-light-blue">95%</span></td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>Chức năng thêm</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-success" style="width: 100%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-green">100%</span></td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>Chức năng sửa</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-success" style="width: 100%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-green">100%</span></td>
                </tr>
                <tr>
                  <td>5.</td>
                  <td>Chức năng xóa</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-success" style="width: 100%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-green">100%</span></td>
                </tr>
                <tr>
                  <td>6.</td>
                  <td>Chức năng tìm kiếm</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-success" style="width: 100%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-green">100%</span></td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>


   

      <!-- /.row -->

    </section>
  </div>
@endsection
