@extends('layouts.dash')
@section('section')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header d-flex align-items-center px-5">
            <h1 class="mr-auto p-2">
                {{ 'Danh sách Đơn vị' }}
            </h1>
        </section>

        <!-- Main content -->
        <!-- <section class="invoice"> -->

        <div class="mt-5" style="width: 95%; margin: auto">
            
            <table class="table table-light table-hover w-75">
                <thead class="bg-primary">
                    <tr>
                        <th style="width: 40px;">#</th>
                        <th>Đơn vị</th>
                        <th style="width:25%;" class="text-center">Đánh giá</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $step = 1; ?>
                    @foreach ($dvbc as $item)
                        <tr id="row_{{ $item->id }}">
                            <td>{{$step}}</td>
                            <td  class="font-weight-bold"> {{ $item->ten_dvbc }}
                            </td>
                            <td class="d-flex justify-content-center">
                                <a href = "{{ route('danhgia.danh-gia')."?dvbc=".$item->id."&category=CSGD" }}"class="btn btn-primary btn-sm mx-2">CSGD</a>
                                <a href = "{{ route('danhgia.danh-gia')."?dvbc=".$item->id."&category=CTDT" }}" class="btn btn-primary btn-sm mx-2">CTDT</a>
                            </td>
                        </tr>
                        <?php $step++; ?>
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
@endpush
