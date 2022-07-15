@extends('layouts.dash')
@section('section')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Thêm Minh Chứng CSGD
            </h1>
            <br>
            {{ Session::get('message') }}
        </section>

        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Điền thông tin Minh Chứng</h3>
                </div>
                <form method="post" action="{{$routeAction}}" name="formulariol" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{@$minhchung->id}}" name="id">
                    <div class="box-body">
                        <div class="f-grid">
                            <div class="form-group f-grid-col">
                                <input type="hidden" name="id_tieuchuan" value="{{$tieuChuan->id}}">
                                <label> Tiêu chuẩn: {{$tieuChuan->ten_tieu_chuan}}</label>
                            </div>
                            <div class="form-group f-grid-col">
                                <input type="hidden" name="id_tieuchi" value="{{$tieuChi->id}}">
                                <label>Tiêu chí: {{$tieuChi->ten_tieu_chi}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tiêu Đề Minh Chứng</label>
                            <input type="text" class="form-control" name="name" value="{{@$minhchung->ten_minh_chung}}" placeholder="Tên minh chứng">
                        </div>
                        @isset($ctdt)
                        <div class="form-group">
                            <label>Chương trình đào tạo</label>
                            <select name="ctdt" id="ctdt" value="{{@$minhchung->id_ctdt}}" >
                                @foreach ($ctdt as $item)
                                    <option value="{{$item->id}}">{{$item->ten_ctdt}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endisset


                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea class="form-control noidung" rows="3" name="content" placeholder="Nhập nội dung mô tả ...">{{@$minhchung->noi_dung}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Chọn File</label>
                            <input name="file" type="file" id="exampleInputFile">
                            <span>{{@$minhchung->file}}</span>
                            <p class="help-block">Chọn file minh chứng của bạn.</p>
                        </div>
                    </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Thêm minh chứng này</button>
            </div>
            </form>
    </div>
    </section>
    </div>
@endsection
