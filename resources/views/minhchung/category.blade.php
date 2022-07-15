@extends('layouts.dash')
@push('styles')
<style>
.string-1 {
    overflow: hidden;
    line-height: 25px;
    -webkit-line-clamp: 2;
    height: 55px;
    display: -webkit-box;
    -webkit-box-orient: vertical;
}
</style>
@endpush
@section('section')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header d-flex justify-content-between px-5">
            <h1>
                Danh Sách Tiêu Chuẩn
            </h1>
        </section>

        <!-- Main content -->
        <!-- <section class="invoice"> -->

        <div class="mt-5" style="width: 95%; margin: auto">
            <table class="table table-bordered yajra-datatable table-hover table-info">
                <thead>
                    <tr>
                        <th style="width:5%;" class="text-center"></th>
                        <th style="width:48%;">Tên Tiêu Chuẩn</th>
                        <th style="width:48%;">Loại tiêu chuẩn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr id="{{ $item->id }}" style="cursor: pointer;">
                            <td class="text-center"><i class="bi bi-plus-circle-fill text-success "></i></td>
                            <td>{{ $item->ten_tieu_chuan }}</td>
                            <td>{{ $item->loai_tieu_chuan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function format(id) {
            // `d` is the original data object for the row
            var data;
            $.ajax({
                url: "{{ url('/minh-chung/get-tieuchi') }}/" + id,
                type: "GET",
                dataType: "json",
                async: false,
                success: function(response) {
                    console.log(response);
                    data = response;
                }
            })
            console.log(data);
            // let element ='<ul class="list-group">';
            //     let host = '{{ url('/') }}';
            // data.forEach(function(item) {
            //     element += `<li class="list-group-item"><a href="{{ url('/') }}/minh-chung/tieu-chi-${id}">${item.ten_tieu_chi}</a></li>`;
            // });
            // element += '</ul>';
            let element = `<table >
                <thead>
                    <tr>
                        <th style="width: 5%">Index</th>
                        <th  style="width: 15%">Ten Tieu Chi</th>
                        <th style="width: 20%"> Noi Dung</th>
                    </tr>
                </thead>
                <tbody>`;
            let host = '{{ url('/') }}';
            let step = 0;
            data.forEach(function(item) {
                step++;
                element +=
                    `<tr>
                        <td>${step}</td>
                        <td><a href="{{ url('/') }}/minh-chung/tieu-chi-${item.id}">${item.ten_tieu_chi}<i class="bi bi-arrow-up-right-square px-2 text-primary"></i></a></td>
                        <td class="string-1">${item.noi_dung}</td>
                    </tr>`;
            });
            element += '</tbody></table>';
            return (element);
        }

        $(document).ready(function() {
            var table = $('.yajra-datatable').DataTable();

            // Add event listener for opening and closing details
            $('.yajra-datatable tbody').on('click', 'td', function() {
                var tr = $(this).closest('tr');
                let id = $(this).parent().attr('id');
                var row = table.row(tr);

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');

                } else {
                    // Open this row
                    row.child(format(id)).show();
                    tr.addClass('shown');
                }
            });
        });
    </script>
@endpush
