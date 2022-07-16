@extends('layouts.dash')
@section('section')
    <div class="content-wrapper" data-id="{{$tieuChi[0]->id_dvbc}}">
        <!-- Content Header (Page header) -->
        <section class="content-header d-flex align-items-center px-5">
            <h1 class="mr-auto p-2">
                {{ 'Tự đánh giá' }}
            </h1>

            @if (Auth::guard('admin')->check())
            <label for="year">Năm:</label>
            <select name="year" id="year" class="form-control mx-3" style="width: 80px;">
                @foreach ($year as $item)
                <option value="{{$item}}" @if($yearCurrent == $item) selected @endif> {{$item}}</option>
                @endforeach
            </select>
            @endif
                <a href="#" class="btn btn-primary mx-5" style="margin-right: 15px;"
                    id="btn-save"><i class="bi bi-bookmark-check"></i> Lưu đánh giá</a>
        </section>

        <!-- Main content -->
        <!-- <section class="invoice"> -->

        <div class="mt-5" style="width: 95%; margin: auto">
            <table class="table table-light table-hover">
                <thead class="bg-primary">
                    <tr>
                        <th style="width: 40px;"></th>
                        <th>Tiêu chuẩn, tiêu chí</th>
                        <th style="width:15%;" class="text-center">Tự đánh giá</th>
                        <th style="width:15%;" class="text-center">Đánh giá của hội đồng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $step1 = 1; ?>
                    @foreach ($tieuChuan as $item)
                        <tr id="row_{{ $item->id }}">
                            <td colspan="4" class="font-weight-bold">Tiêu chuẩn {{ $step1 . ': ' . $item->ten_tieu_chuan }}
                            </td>

                        </tr>
                        <?php $step2 = 1; ?>
                        @foreach ($tieuChi as $itemTc)
                            @if ($item->id == $itemTc->id_tieu_chuan)
                                <tr class="child_{{ $item->id }}" id="row_child_{{ $itemTc->id }}">
                                    <td></td>
                                    <td class="border-right">Tiêu chí {{ $step2 . ': ' . $itemTc->ten_tieu_chi }}</td>
                                    <td>
                                        <div class="form-group m-0">
                                            <select class="form-control tu_danh_gia" data-id={{ $itemTc->id_danh_gia }}
                                                @if (Auth::guard('admin')->check()) disabled @endif>
                                                <option value="3" @if ($itemTc->tu_danh_gia == 3) selected @endif>Tốt
                                                </option>
                                                <option value="2" @if ($itemTc->tu_danh_gia == 2) selected @endif>Khá
                                                </option>
                                                <option value="1" @if ($itemTc->tu_danh_gia == 1) selected @endif>Đạt
                                                </option>
                                                <option value="0" @if ($itemTc->tu_danh_gia === 0) selected @endif>
                                                    Chưa Đạt</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group m-0">
                                            <select class="form-control danh_gia" data-id={{ $itemTc->id_danh_gia }}
                                                @if (Auth::guard('user')->check()) disabled @endif>
                                                <option value="-1" @if ($itemTc->danh_gia == null) selected @endif>Chưa đánh giá
                                                </option>
                                                <option value="3" @if ($itemTc->danh_gia == 3) selected @endif>Tốt
                                                </option>
                                                <option value="2" @if ($itemTc->danh_gia == 2) selected @endif>
                                                    Khá</option>
                                                <option value="1" @if ($itemTc->danh_gia == 1) selected @endif>
                                                    Đạt</option>
                                                <option value="0" @if ($itemTc->danh_gia === 0) selected @endif>
                                                    Chưa Đạt</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        <?php $step1++; ?>
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
                    <h3 class="modal-title" id="exampleModalLongTitle">File minh chứng</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        @if (Auth::guard('user')->check())
            var typeUser = "user";
        @else
            var typeUser = "admin";
        @endif

        $("#btn-save").on("click", function() {
            console.log("xx");
            data = []
            if (typeUser == 'user') {
                $('.tu_danh_gia').each(function(){
                    let id = $(this).data("id");
                    let value = $(this).val();
                    console.log(id);
                    console.log(value);
                    data.push({
                        id: id,
                        value: value
                    });
                })
            }
            if (typeUser == 'admin') {
                $('.danh_gia').each(function() {
                    let id = $(this).data("id");
                    let value = $(this).val();
                    if(value == '-1'){
                        value = null;
                    }
                    data.push({
                        id: id,
                        value: value
                    });
                })
            }

            data = JSON.stringify(data)
            let dataAjax = {
                data: data,
                _token: '{{csrf_token()}}',
                type_user: typeUser
            }
            console.log(dataAjax);
            $.ajax({
                url: "{{route("danhgia.save")}}",
                type: "post",
                data: dataAjax,
                typeData: 'json',
                success: function(data){
                    alert("Compelete!");
                },
                error:function(data){
                    alert("Error");
                    console.log(data);
                }
            })
        })
        $("#year").on("change", function(){
            location.href = location.origin +location.pathname+"?dvbc="+$(".content-wrapper").data("id")+"&year="+$(this).val();
        })
    </script>
@endpush
