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
                <div class="navbar-custom-menu"style="margin-left: 95%;">

                    <ul class="nav navbar-nav">
                      <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <img src="{{url('/image/avatar.png')}}" class="user-image" alt="User">
                          {{--<span class="hidden-xs">{{ Auth::user()->name }}</span> --}}
                          <!-- comment hear -->

                        </a>
                        <ul class="dropdown-menu" style="background-color: #F1F1F1; width:50%;">
                            <li class="user-footer">
                                <a class="btn btn-default" href="{{ route('profile') }}">
                                    Tài khoản
                                </a>
                          </li>
                          <li class="user-footer">
                            <a class="btn btn-default" href="{{ route('viewChangePassword') }}">
                                Đổi mật khẩu
                            </a>
                      </li>

                          <li class="user-footer">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-default " style="width:100%;">Đăng Xuất</button>
                            </form>

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
                        <img src="{{ url('/image/avatar.png') }}" class="img-circle" alt="User">
                    </div>
                    <div class="pull-left info">
                        @if (\Auth::guard('user')->check())

                <a  href="{{ route('profile') }}">{{ \Auth::guard('user')->user()->name }}</a>
            @else
                <a  href="{{ route('profile') }}" >{{ \Auth::guard('admin')->user()->name }}</a>
            @endif
                        <!-- comment hear -->
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                                    class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">TÙY CHỌN QUẢN LÝ</li>

                    <li>
                        <a href="{{ route('minhchung.show-tieu-chuan') }}">
                            <i class="fa fa-share"></i> <span>Minh Chứng</span>
                        </a>
                    </li>

                    @if (\Auth::guard('admin')->check() && Auth::user()->permission == 'admin')
                        <li>
                            <a href="{{ url('/tieuchuan') }}">
                                <i class="fa fa-share"></i> <span>Tiêu Chuẩn</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/tieuchi') }}">
                                <i class="fa fa-share"></i> <span>Tiêu Chí</span>
                            </a>
                        </li>
                    @endif

                    <!-- /.quản lý tiêu chí -->
                    <!-- quản lý báo cáo -->
                    <li >
                        <a
                            @if (Auth::guard('admin')->check()) href="{{ route('danhgia.show-CTDT') }}"
                            @else
                            href="{{ route('danhgia.danh-gia') . '?dvbc=' . Auth::guard('user')->user()->id_dvbc . '&category=CSGD' }}" @endif>
                            <i class="fa fa-edit"></i> <span>Đánh giá</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                    </li>

                    @if (\Auth::guard('admin')->check() && Auth::user()->permission == 'admin')
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Người dùng</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{ url('/users-hddg') }}"><i class="fa fa-circle-o"></i> Tài khoản HĐĐG</a>
                                </li>
                                <li><a href="{{ url('/users-dvbc') }}"><i class="fa fa-circle-o"></i> Tài khoản DVBC</a>
                                </li>
                                <!-- <li><a href="{{ url('/timuser') }}"><i class="fa fa-circle-o"></i> Tìm kiếm người dùng</a></li> -->
                            </ul>
                        </li>
                    @endif
                    <!-- /.quản lý user -->


                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        @yield('section')
    </div>
    <!-- ./wrapper -->
@stop
