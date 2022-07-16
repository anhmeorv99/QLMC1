@extends('layouts.dash')
@section('section')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header d-flex justify-content-between px-5">
        <h1>
            Thông tin tài khoản
        </h1>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <hr>
                            <div class="col">
                                <div class="col-md-8 offset-2">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text"  name="name" readonly class="form-control" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>

                                <div class="col-md-8 offset-2">
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text"  name="username" readonly class="form-control" value="{{ Auth::user()->username }}">
                                    </div>
                                </div>

                                <div class="col-md-8 offset-2">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" name="email" readonly class="form-control" value="{{ Auth::user()->email }}">
                                    </div>
                                </div>

                                <div class="col-md-8 offset-2">
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <input type="text"  name="phone" readonly class="form-control" value="{{ Auth::user()->phone }}">
                                    </div>
                                </div>

                                <div class="col-md-8 offset-2">
                                    <div class="form-group">
                                        <label for="">Address</label>
                                        <input type="text"  name="address" readonly class="form-control" value="{{ Auth::user()->address }}">
                                    </div>
                                </div>

                                @if (Auth::guard('user')->check())
                                    <div class="col-md-8 offset-2">
                                        <div class="form-group">
                                            <label for="">DVBC</label>
                                            <input type="text"  name="ten_dvbc" readonly class="form-control" value="{{$dvbc->ten_dvbc}}">
                                        </div>
                                    </div>
                                @endif
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body input').val(recipient)
        })
    $('#exampleModal').modal('show');

    });

    function editFunc(id) {
    $("#exampleModal").modal("show");
    // $("#btn-submit-detail").text("Cập nhật");
    // $("#modalLabelDetail").text("Cập nhật người dùng");
    // $("#password").parent().hide();
    // $("#password-confirm").parent().hide();

    // let address = $("#row_" + id).data('address');
    // let phone = $("#row_" + id).data('phone');
    // let name = $("#row_" + id).find("td").eq(1).text();
    // let username = $("#row_" + id).find("td").eq(2).text();
    // let email = $("#row_" + id).find("td").eq(3).text();
    // let permission = $("#row_" + id).find("td").eq(4).text();
    // $("#name").val(name);
    // $("#username").val(username);
    // $("#email").val(email);
    // $("#phone").val(phone);
    // $("#address").val(address);
    // $("#permission").val(permission);
    // $("#id-detail").val(id);
    // $("#btn-submit-detail").data('type', 'edit');

}


@endpush
