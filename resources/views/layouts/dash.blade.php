@extends('layouts.plan')
@section('body')
<div class="wrapper">


  <header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">QL<b>MC</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">QuanLy<b>MinhChung</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="image/avatar.png" class="user-image" alt="User">
              {{--<span class="hidden-xs">{{ Auth::user()->name }}</span> --}}
              <!-- comment hear -->

            </a>
            <ul class="dropdown-menu" style="background-color: #F1F1F1; width:50%;">
              <li class="user-footer" style="background-color: #F1F1F1; width: 60%;margin-left: 50px;">
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Đăng Xuất</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="image/avatar.png" class="img-circle" alt="User">
        </div>
        <div class="pull-left info">
          {{-- <p>{{ Auth::user()->name }}</p> --}}
          <!-- comment hear -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">TÙY CHỌN QUẢN LÝ</li>
        <!-- quản lý minh chứng -->
        <!--   <li class="active treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Minh Chứng</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{url('/minhchung')}}"><i class="fa fa-circle-o"></i>Danh sách Minh Chứng CSGD</a></li>
            <li><a href="{{url('/themminhchung')}}"><i class="fa fa-circle-o"></i>Thêm Một Minh Chứng</a></li>
            <li><a href="{{url('/timminhchung')}}"><i class="fa fa-circle-o"></i> Tìm Kiếm Minh Chứng</a></li>
          </ul>
        </li> -->
        <li>
          <a href="{{route('minhchung.show-tieu-chuan')}}">
            <i class="fa fa-share"></i> <span>Minh Chứng</span>
          </a>
        </li>
        <!-- /.quản lý minh chứng -->
        <!-- quản lý tiêu chuẩn -->
        <!--     <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Tiêu Chuẩn</span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{url('/tieuchuan')}}"><i class="fa fa-circle-o"></i> Danh Sách Tiêu Chuẩn</a></li>
            <li><a href="{{url('/themtieuchuan')}}"><i class="fa fa-circle-o"></i> Thêm Tiêu Chuẩn</a></li>
          </ul>
        </li> -->
        <li>
          <a href="{{ url('/tieuchuan')}}">
            <i class="fa fa-share"></i> <span>Tiêu Chuẩn</span>
          </a>
        </li>
        <!-- /.quản lý tiêu chuẩn -->
        <!-- quản lý tiêu chí -->
        <!--      <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Tiêu Chí</span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{url('/tieuchi')}}"><i class="fa fa-circle-o"></i> Danh Sách Tiêu Chí</a></li>
            <li><a href="{{url('/themtieuchi')}}"><i class="fa fa-circle-o"></i> Thêm Tiêu Chí</a></li>
            <li><a href="{{url('/danhgiatieuchi')}}"><i class="fa fa-circle-o"></i> Đánh giá tiêu chí</a></li>
          </ul>
        </li> -->
        <li>
          <a href="{{ url('/tieuchi')}}">
            <i class="fa fa-share"></i> <span>Tiêu Chí</span>
          </a>
        </li>
        <!-- /.quản lý tiêu chí -->
        <!-- quản lý báo cáo -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Báo Cáo</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Viết Báo cáo tự đánh giá
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('/vietbaocaocsgd')}}"><i class="fa fa-circle-o"></i>Cấp CSGD </a></li>
                <li><a href="{{url('/vietbaocaoctdt')}}"><i class="fa fa-circle-o"></i>Cấp CTDT </a></li>
              </ul>
            </li>
            <li><a href="{{ url('/danhsachbaocaocsgd')}}"><i class="fa fa-circle-o"></i> Danh sách báo cáo CSGD</a></li>
            <li><a href="{{ url('/danhsachbaocaoctdt')}}"><i class="fa fa-circle-o"></i> Danh sách báo cáo CTDT</a></li>
          </ul>
        </li>
        <!-- /.quản lý báo cáo -->
        <!-- Quản lý user -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Người dùng</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/users-hddg')}}"><i class="fa fa-circle-o"></i> Tài khoản HĐĐG</a></li>
            <li><a href="{{ url('/users-dvbc')}}"><i class="fa fa-circle-o"></i> Tài khoản DVBC</a></li>
            <!-- <li><a href="{{ url('/timuser')}}"><i class="fa fa-circle-o"></i> Tìm kiếm người dùng</a></li> -->
          </ul>
        </li>
        <!-- /.quản lý user -->

        <!-- thông tin nhóm và công việc -->
        <li><a href="{{ url('/nhomthuchien') }}"><i class="fa fa-book"></i> <span>Nhóm Thực Hiện</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  @yield('section')
</div>
<!-- ./wrapper -->
@stop
