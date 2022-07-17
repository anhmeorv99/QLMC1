@extends('layouts.dash')
@section('section')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header d-flex justify-content-between px-5">
        <h1>
            Đổi mật khẩu
        </h1>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="panel-body">
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if (session('error-confirm'))
                            <div class="alert alert-danger">
                                {{ session('error-confirm') }}
                            </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if($errors)
                                @foreach ($errors->all() as $error)

                                    <div class="alert alert-danger">
                                        @if ($errors->has('password'))
                                            {{$errors->first('password')}}
                                        @elseif ($errors->has('current-password'))
                                            {{ $errors->first('current-password') }}
                                        @endif

                                    </div>

                                @endforeach
                            @endif

                        <h4>Đổi mật khẩu</h4>
                        <hr>

                            <div class="col">
                                <form action="{{route('updateChangePassword')}}" method="POST">
                                    @csrf
                                <div class="col-md-8 offset-2">
                                    <div class="form-group">
                                        <label for="">Mật khẩu hiện tại</label>
                                        <input type="password" name="current_password" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-8 offset-2">
                                    <div class="form-group">
                                        <label for="">Mật khẩu mới</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-8 offset-2">
                                    <div class="form-group">
                                        <label for="">Nhập lại mật khẩu</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 offset-5">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Đổi mật khẩu
                                        </button>
                                    </div>
                                </div>
                        </form>

                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
@endsection

