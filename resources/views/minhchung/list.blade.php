@extends('layouts.dash')
@section('section')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header d-flex justify-content-between px-5">
            <h1>
                {{ $tieuChi->ten_tieu_chi }}
            </h1>
            @if (Auth::guard('user')->check())
                <a href="{{ route('minhchung.show-create') }}" class="btn btn-primary" style="margin-right: 15px;"><i
                        class="bi bi-bookmark-plus-fill"></i></a>
            @endif
        </section>

        <!-- Main content -->
        <!-- <section class="invoice"> -->

        <div class="mt-5" style="width: 95%; margin: auto">
            <table class="table table-bordered yajra-datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên MC</th>
                            <th>Đơn Vị Báo Cáo</th>
                        <th>Kiểu MC</th>
                        <th>Nội Dung</th>
                        <th>File</th>

                        <th>Trạng thái</th>
                        <th style="width:15%;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr id="row_{{ $item->id }}">
                            <td class="sorting_1">{{ $item->id }}</td>
                            <td>{{ $item->ten_minh_chung }}</td>
                            <td>{{ $item->ten_dvbc }}</td>
                            <td>{{ $tieuChuan->loai_tieu_chuan }}</td>
                            <td>{{ $item->noi_dung }}</td>
                            <td>{{ $item->file }}</td>
                            <td>{{ $item->duyet }}</td>
                            <td>
                                <div class="text-center d-flex justify-content-center">

                                    <button type="button" class="btn btn-link btn-preview" data-toggle="modal"
                                        data-hash="{{ $item->hash_file }}"
                                        data-target="#exampleModalCenter">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    @if (Auth::guard('user')->check() )
                                    <a href="{{ route('minhchung.show-edit', ['id'=>$item->id]) }}" class="edit btn btn-link btn-sm">
                                        <i class="bi bi-pencil-square text-primary"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="deleteMC({{$item->id}})" class="edit btn btn-link btn-sm"><i
                                            class="bi bi-trash3 text-danger"></i></a>
                                    @else
                                    {{-- <a  class="btn btn-primary btn-sm btn-accept" data-id="{{$item->id}}">
                                        <i class="bi bi-check-circle"></i>
                                    </a> --}}
                                    <div class="dropdown">
                                        <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton{{$item->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{$item->id}}" data-id="{{$item->id}}">
                                            @if($item->duyet == 'REQUEST')
                                          <a class="dropdown-item btn-accept" href="#">Duyet</a>
                                          <a class="dropdown-item btn-denine" href="#">Khong duyet</a>
                                          @elseif ($item->duyet == 'ACCEPTED')
                                          <a class="dropdown-item btn-denine" href="#">Khong duyet</a>
                                          @else
                                          <a class="dropdown-item btn-accept" href="#">Duyet</a>
                                          @endif
                                        </div>
                                      </div>
                                    @endif

                                    <a href="{{ url('/uploads') }}/{{ $item->hash_file }}"
                                        class="glyphicon glyphicon-download btn btn-icon btn-link" download="{{ $item->file }}"></a>

                                </div>
                            </td>
                        </tr>
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

    <script type="text/javascript">
        $(function() {
            var table = $('.yajra-datatable').DataTable();
            $(".btn-preview").on("click", function() {
                    let hash = $(this).data('hash');
                    console.log(hash);
                    hash = hash.toLowerCase()
                    let url = "{{ url('/uploads') }}/" + hash;
                    if (hash.includes(".pdf") || hash.includes(".txt")) {
                        $('#exampleModalCenter .modal-body').html('<embed src="' + url +
                            '" type="application/pdf" style="height: 700px;width: -webkit-fill-available">');
                    } else if (hash.includes(".doc") || hash.includes(".docx")) {
                        $('#exampleModalCenter .modal-body').html('<embed src="' + url +
                            '" type="application/msword" style="height: 700px;width: -webkit-fill-available">'
                            );
                    } else if (hash.includes('.jpg') || hash.includes('.png')){
                        $(' .modal-body').html('<img src="' + url +
                            '" style="height: 700px;width: -webkit-fill-available">');
                    }
            });

            // $(".btn-accept").on("click", function(){
            $('.yajra-datatable tbody').on('click', '.btn-accept', function() {
                let id = $(this).parent().data('id');
                console.log(id);
                console.log($(this).html());
                ajaxStatus(id, 'ACCEPTED');
            });
            // $(".btn-denine").on("click", function(){
                $('.yajra-datatable tbody').on('click', '.btn-denine', function() {

                let id = $(this).parent().data('id');
                console.log(id);
                console.log($(this).html());

                ajaxStatus(id, 'NOT_ACCEPTED');
            });
        });
        function ajaxStatus(id, status) {
            const download_element = (hash_file, file)=>{
                let url = '{{ url("/uploads") }}/'+hash_file;
                return `<a href=${url} class="glyphicon glyphicon-download btn btn-icon btn-link" download="${file}"></a>`;
            };
            $.ajax({
                url: "{{ route('minhchung.update-status') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}",
                    status: status
                },
                success: function(data) {
                    console.log(data);
                    // $("#row_" + id).remove();
                    var table = $('.yajra-datatable').DataTable();
                    let row = table.row('#row_' + data.status.id);
                    let row2 = table.row('#row_' + data.status.id).node();
                    let kieuMC = $(row2).find('td').eq(2).text();
                    if (status == 'ACCEPTED') {
                        newRow = row.data([
                            `${data.status.id}`,
                            `${data.status.ten_minh_chung}`,
                            `${data.status.ten_dvbc}`,
                            `${kieuMC}`,
                            `${data.status.noi_dung}`,
                            `${data.status.file}`,
                            `${status}`,
                            `<div class="text-center d-flex justify-content-center">
                                <button type="button" class="btn btn-link btn-preview" data-toggle="modal"
                                    data-hash="${data.status.hash_file}" data-target="#exampleModalCenter">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton${data.status.id}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton${data.status.id}" data-id="${data.status.id}">
                                        <a class="dropdown-item btn-denine" href="#">Khong duyet</a>
                                    </div>
                                </div>
                                ${download_element(data.status.hash_file, data.status.file)}
                            </div>`
                        ]).draw(false).node();
                        $(newRow).trigger("change");
                    } else {
                        newRow = row.data([
                            `${data.status.id}`,
                            `${data.status.ten_minh_chung}`,
                            `${data.status.ten_dvbc}`,
                            `${kieuMC}`,
                            `${data.status.noi_dung}`,
                            `${data.status.file}`,
                            `${status}`,
                            `<div class="text-center d-flex justify-content-center">
                                <button type="button" class="btn btn-link btn-preview" data-toggle="modal"
                                    data-hash="${data.status.hash_file}" data-target="#exampleModalCenter">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton${data.status.id}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton${data.status.id}" data-id="${data.status.id}">
                                        <a class="dropdown-item btn-accept" href="#">Duyet</a>
                                    </div>
                                </div>
                                ${download_element(data.status.hash_file, data.status.file)}
                            </div>`
                        ]).draw(false).node();
                        $(newRow).trigger("change");
                    }

                },
                error: function(data) {
                    console.log(data);
                    alert('Co loi xay ra');
                }
            });
        }

        function deleteMC(id){
            if (confirm("Bạn có muốn xóa minh chứng này không?")) {

                $.ajax({
                        url: "{{ route('minhchung.delete-minh-chung') }}",
                        type: "delete",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            console.log(data);
                            var table = $('.yajra-datatable').DataTable();
                            table.row('#row_' + id).remove().draw();
                        },
                        error: function(data) {
                            console.log(data);
                            alert('Co loi xay ra');
                        }
                    });

            };
        }
    </script>
@stop
