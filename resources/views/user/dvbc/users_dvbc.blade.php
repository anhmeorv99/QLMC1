@extends('layouts.dash')

@section('section')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header d-flex justify-content-between px-5">
        <h1>
            Danh Sách Tài Khoản Đơn Vị Báo Cáo
        </h1>
        <a href="#" class="btn btn-primary" style="margin-right: 15px;" id="add_user"> <i class="bi bi-person-plus-fill"></i></a>

    </section>

    <!-- Main content -->
    <!-- <section class="invoice"> -->

    <div class="mt-5" style="width: 95%; margin: auto">
        <table class="table table-bordered yajra-datatable table-hover table-info">
            <thead>
                <tr>
                    <th style="width:5%;">ID</th>
                    <th style="width:25%;">Tên Người Dùng</th>
                    <th style="width:25%;">Tên tài khoản</th>
                    <th style="width:15%;">Tên DVBC</th>
                    <th style="width:15%;">Email</th>
                    <th style="width:10%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($list as $item)
                <tr id="row_{{$item->id}}" data-address="{{$item->address}}" data-phone="{{$item->phone}}">
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->username}}</td>
                    <td data-id_dvbc="{{$item->id_dvbc}}">{{$item->dvbc->ten_dvbc}}</td>
                    <td>{{$item->email}}</td>
                    <td>
                        <div class="text-center">
                            <button class="btn btn-primary" onclick="editFun({{$item->id}})">
                                <i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-danger" onclick="deleteFun({{$item->id}})"> <i class="bi bi-trash3"></i></button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- </section> -->
    <!-- /.content -->
    <div class="clearfix"></div>
</div>
<div class="modal fade" id="modal_del" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Xóa người dùng</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Xác nhận xóa người dùng này?
            </div>
            <div class="modal-footer">
                <input type="hidden" id="id-del">
                <a class="btn btn-success" id="btn-submit-del">Đồng Ý</a>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="modalLabelDetail" data-route-add="{{ route('add-user-dvbc') }}" data-route-edit="{{ route('edit-user-dvbc') }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalLabelDetail"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-detail">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="">
                        <small id="error_name" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" class="form-control" id="username" aria-describedby="emailHelp" placeholder="">
                        <small id="error_username" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Đơn vị báo cáo</label>
                        <select name="id_dvbc" id="id_dvbc" class="form-control">
                            @foreach($listDVBC as $item)
                            <option value="{{$item->id}}">{{$item->ten_dvbc}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="">
                        <small id="error_email" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password" aria-describedby="emailHelp" placeholder="">
                        <small id="error_password" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" id="password-confirm" aria-describedby="emailHelp" placeholder="">
                        <small id="error_password_confirm" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" id="phone" aria-describedby="emailHelp" placeholder="">
                        <small id="error_phone" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" id="address" aria-describedby="emailHelp" placeholder="">
                        <small id="error_address" class="form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id-detail">
                    <a class="btn btn-success" id="btn-submit-detail" data-type></a>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Hủy</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
    $(function() {
        var table = $('.yajra-datatable').DataTable();
    });
    $("#btn-submit-del").click(function() {
        let id = $("#id-del").val();
        console.log(id);
        $.ajax({
            url: "{{ route('delete-user-dvbc') }}",
            type: "delete",
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            dataType: 'json',
            success: function(data) {
                $("#row_" + id).remove();
                $("#modal_del").modal("hide");
                var table = $('.yajra-datatable').DataTable();
                table.row("#row_" + id).remove().draw();
            }
        });
    });

    function deleteFun(id) {
        $("#id-del").val(id);
        $("#modal_del").modal("show");
    }

    $("#add_user").on("click", function() {
        $("#modal_detail").modal("show");
        $("#btn-submit-detail").text("Thêm");
        $("#modalLabelDetail").text("Thêm người dùng");
        $("#password").parent().show();
        $("#password-confirm").parent().show();
        $("#btn-submit-detail").data('type', 'add');
    });
    $("#btn-submit-detail").on("click", function() {
        let name = $("#name").val();
        let username = $("#username").val();
        let email = $("#email").val();
        let password = $("#password").val();
        let password_confirm = $("#password-confirm").val();
        let phone = $("#phone").val();
        let address = $("#address").val();
        let id_dvbc = $("#id_dvbc").val();
        let type = $("#btn-submit-detail").data('type');
        let check = validator(name, username, email, password, password_confirm, type);
        if (!check) {
            return;
        }
        let data = {
            name: name,
            username: username,
            email: email,
            password: password,
            password_confirmation: password_confirm,
            phone: phone,
            address: address,
            id_dvbc: id_dvbc,
            _token: "{{ csrf_token() }}"
        };

        // return;
        let url;
        if (type == "add") {
            url = $("#modal_detail").data('route-add');
        } else {
            url = $("#modal_detail").data('route-edit');
            data.id = $("#id-detail").val();
        }
        console.log("url " + url);
        console.log(data);
        $.ajax({
            url: url,
            type: "post",
            data: data,
            dataType: 'json',
            success: function(data) {
        console.log(data);
                
                $("#modal_detail").modal("hide");
                // location.reload();
                var table = $('.yajra-datatable').DataTable();
                let newRow
                if (type == "add") {
                    newRow = table.row.add([
                        `${data.user.id}`,
                        `${data.user.name}`,
                        `${data.user.username}`,
                        `${data.ten_dvbc}`,
                        `${data.user.email}`,
                        '<button class="btn btn-primary mx-1" onclick="editFun(' +
                        data.user.id + ')"><i class="bi bi-pencil-square"></i></button>' +
                        '<button class="btn btn-danger mx-1" onclick="deleteFun(' +
                        data.user.id + ')"><i class="bi bi-trash3"></i></button>'
                    ]).draw(false).node();
                    newRow.id = 'row_' + data.user.id;
                } else {
                    let row = table.row('#row_' + data.user.id);
                    newRow = row.data([
                        `${data.user.id}`,
                        `${data.user.name}`,
                        `${data.user.username}`,
                        `${data.ten_dvbc}`,
                        `${data.user.email}`,
                        '<button class="btn btn-primary mx-1" onclick="editFun(' +
                        data.user.id + ')"><i class="bi bi-pencil-square"></i></button>' +
                        '<button class="btn btn-danger mx-1" onclick="deleteFun(' +
                        data.user.id + ')"><i class="bi bi-trash3"></i></button>'
                    ]).draw(false).node();
                }
                // $(newRow).attr("data-address", data.address);
                // $(newRow).attr("data-phone", data.phone);
                $(newRow).find('td').eq(3).attr('data-id_dvbc', data.user.id_dvbc);
                $(newRow).find('td').eq(5).addClass('text-center');
                $(newRow).data("phone", data.user.phone);
                $(newRow).data("address", data.user.address);
                $(newRow).trigger("change");
                $("form").trigger("reset");
            },
            error: function(data) {
                console.log(data);
                // if (data.status == 422) {
                let errors = JSON.parse(data.responseText);
                errors = errors.errors;
                console.log(errors);
                if (errors.name) {
                    $("#error_name").text(errors.name);
                }
                if (errors.username) {
                    $("#error_username").text(errors.username);
                }
                if (errors.email) {
                    $("#error_email").text(errors.email);
                }
                if (errors.password) {
                    $("#error_password").text(errors.password);
                }
                if (errors.password_confirmation) {
                    $("#error_password_confirm").text(errors.password_confirmation);
                }
                // }
            }
        });

    })

    function editFun(id) {
        $("#modal_detail").modal("show");
        $("#btn-submit-detail").text("Cập nhật");
        $("#modalLabelDetail").text("Cập nhật người dùng");
        $("#password").parent().hide();
        $("#password-confirm").parent().hide();

        let address = $("#row_" + id).data('address');
        let phone = $("#row_" + id).data('phone');
        let name = $("#row_" + id).find("td").eq(1).text();
        let username = $("#row_" + id).find("td").eq(2).text();
        let id_dvbc = $("#row_" + id).find("td").eq(3).attr('data-id_dvbc')
        let email = $("#row_" + id).find("td").eq(4).text();
        $("#name").val(name);
        $("#username").val(username);
        $("#email").val(email);
        $("#phone").val(phone);
        $("#address").val(address);
        $("#id_dvbc").val(id_dvbc);
        $("#id-detail").val(id);
        $("#btn-submit-detail").data('type', 'edit');

    }


    function validator(name, username, email, password, password_confirm, type) {
        let check = true;
        if (name == "") {
            $("#error_name").text("Vui lòng nhập tên");
            check = false;
        } else {
            $("#error_name").text("");
        }
        if (username == "") {
            $("#error_username").text("Vui lòng nhập tên đăng nhập");
            check = false;
        } else {
            $("#error_username").text("");
        }
        if (email == "") {
            $("#error_email").text("Vui lòng nhập email");
            check = false;
        } else {
            $("#error_email").text("");
        }
        if (type == "add") {
            if (password == "") {
                $("#error_password").text("Vui lòng nhập mật khẩu");
                check = false;
            } else {
                $("#error_password").text("");
            }
            if (password_confirm == "") {
                $("#error_password_confirm").text("Vui lòng nhập lại mật khẩu");
                check = false;
            } else {
                $("#error_password_confirm").text("");
            }

            if (password_confirm != password) {
                $("#error_password_confirm").text("Mật khẩu không khớp");
                check = false;
            } else {
                $("#error_password_confirm").text("");
            }
        }
        return check;
    }
</script>
@endpush