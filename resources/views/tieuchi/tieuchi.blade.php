@extends('layouts.dash')
@section('section')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header d-flex justify-content-between px-5">
    <h1>
      Danh Sách Tiêu Chí
    </h1>
    <a href="#" class="btn btn-primary" style="margin-right: 15px;" id="add_tieuchi"> <i class="bi bi-file-earmark-plus-fill"></i></a>
  </section>

  <!-- Main content -->
  <!-- <section class="invoice"> -->

  <div class="mt-5" style="width: 95%; margin: auto">
    <table class="table table-bordered yajra-datatable table-hover table-info">
      <thead>
        <tr>
          <th style="width:5%;">ID</th>
          <th style="width:20%;">Tên Tiêu Chí</th>
          <th style="width:20%;">Tên tiêu chuẩn</th>
          <th style="width:10%;">Loại tiêu chuẩn</th>
          <th style="width:30%;">Nội dung</th>
          <th style="width:10%;">Thao tác</th>
        </tr>
      </thead>
      <tbody>

        @foreach($list as $item)
        <tr id="row_{{$item->id}}">
          <td>{{$item['id']}}</td>
          <td>{{$item->ten_tieu_chi}}</td>
          <td data-tieuchuan="{{$item->id_tieu_chuan}}">{{$item->tieuchuan->ten_tieu_chuan}}</td>
          <td>{{$item->tieuchuan->loai_tieu_chuan}}</td>
          <td>{{$item->noi_dung}}</td>
          <td class="text-center">
            <button class="btn btn-primary" onclick="editFunc({{$item->id}})">
              <i class="bi bi-pencil-square"></i></button>
            <button class="btn btn-danger" onclick="deleteFunc({{$item->id}})"> <i class="bi bi-trash3"></i></button>
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
        <h3 class="modal-title" id="exampleModalLabel">Xóa tiêu chí</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Xác nhận xóa tiêu chí này?
      </div>
      <div class="modal-footer">
        <input type="hidden" id="id-del">
        <a class="btn btn-success" id="btn-submit-del">Đồng Ý</a>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Hủy</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="modalLabelDetail" data-route-add="{{ route('create-tieuchi') }}" data-route-edit="{{ route('update-tieuchi') }}" aria-hidden="true">
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
            <label>Tên tiêu chí</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="">
            <small id="error_name" class="form-text text-danger"></small>
          </div>


          <div class="form-group">
            <label>Tiêu chuẩn</label>
            <select name="tieuchuan" id="tieuchuan" class="form-control">
              @foreach($listTieuChuan as $itemTieuChuan)
              <option value="{{$itemTieuChuan->id}}__{{$itemTieuChuan->loai_tieu_chuan}}">{{$itemTieuChuan->ten_tieu_chuan}} - {{$itemTieuChuan->loai_tieu_chuan}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Nội dung</label>
            <textarea name="content" id="content" class="form-control" rows="3"></textarea>
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
    $.ajax({
      url: "{{ route('delete-tieuchi') }}",
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

  function deleteFunc(id) {
    $("#id-del").val(id);
    $("#modal_del").modal("show");
  }

  $("#add_tieuchi").on("click", function() {
    $("#modal_detail").modal("show");
    $("#btn-submit-detail").text("Thêm");
    $("#modalLabelDetail").text("Thêm tiêu chí");
    $("#btn-submit-detail").data('type', 'add');
  });

  //todo
  $("#btn-submit-detail").on("click", function() {
    let name = $("#name").val();
    let tieuchuan = $("#tieuchuan").val();
    let typeTieuChi = tieuchuan.split("__")[1];
    tieuchuan = tieuchuan.split("__")[0];

    let content = $("#content").val();

    let type = $("#btn-submit-detail").data('type');
    let check = validator(name);

    if (!check) {
      return;
    }
    var input_data = {
      name: name,
      type: typeTieuChi,
      tieuchuan: tieuchuan,
      content: content,
      _token: "{{ csrf_token() }}"
    };

    // return;
    let url;
    if (type == "add") {
      url = $("#modal_detail").data('route-add');
    } else {
      url = $("#modal_detail").data('route-edit');
      input_data.id = $("#id-detail").val();
    }

    $.ajax({
      url: url,
      type: "post",
      data: input_data,
      dataType: 'json',
      success: function(data) {
        $("#modal_detail").modal("hide");
        var table = $('.yajra-datatable').DataTable();
        let newRow;


        if (type == "add") {
          // .id = 'row_' + data.tieuchi.id
          newRow = table.row.add([
            `${data.tieuchi.id}`,
            `${data.tieuchi.ten_tieu_chi}`,
            `${data.ten_tieu_chuan}`,
            `${input_data.type}`,
            `${data.tieuchi.noi_dung}`,
            '<div class="text-center"><button class="btn btn-primary mx-1" onclick="editFunc(' +
            data.tieuchi.id + ')"><i class="bi bi-pencil-square"></i></button>' +
            '<button class="btn btn-danger mx-1" onclick="deleteFunc(' +
            data.tieuchi.id + ')"><i class="bi bi-trash3"></i></button></div>'
          ]).draw(false).node();
          newRow.id = 'row_' + data.tieuchi.id;
        } else {
          let row = table.row('#row_' + data.tieuchi.id);
          newRow = row.data([
            `${data.tieuchi.id}`,
            `${data.tieuchi.ten_tieu_chi}`,
            `${data.ten_tieu_chuan}`,
            `${input_data.type}`,
            `${data.tieuchi.noi_dung}`,
            '<button class="btn btn-primary mx-1" onclick="editFunc(' +
            data.tieuchi.id + ')"><i class="bi bi-pencil-square"></i></button>' +
            '<button class="btn btn-danger mx-1" onclick="deleteFunc(' +
            data.tieuchi.id + ')"><i class="bi bi-trash3"></i></button>'
          ]).draw(false).node();
        }

        $(newRow).find('td').eq(2).attr('data-tieuchuan', data.tieuchi.id_tieu_chuan);
        $(newRow).find('td').eq(5).addClass('text-center');
        $(newRow).trigger("change");

        $("form").trigger("reset");
      },
      error: function(data) {
        // if (data.status == 422) {
        let errors = JSON.parse(data.responseText);
        errors = errors.errors;
        console.log(errors);
        if (errors.name) {
          $("#error_name").text(errors.name);
        }
      }
    });

  })

  function editFunc(id) {
    $("#modal_detail").modal("show");
    $("#btn-submit-detail").text("Cập nhật");
    $("#modalLabelDetail").text("Cập nhật Tiêu chí");

    let name = $("#row_" + id).find("td").eq(1).text();
    let tieuchuanId = $("#row_" + id).find("td").eq(2).attr('data-tieuchuan')
    let tieuchuanText = $("#row_" + id).find("td").eq(2).text();
    let content = $("#row_" + id).find("td").eq(4).text();

    $("#name").val(name);
    $("#content").val(content);
    $("#tieuchuan").val(tieuchuanId);
    $("#id-detail").val(id);
    $("#btn-submit-detail").data('type', 'edit');
  }


  function validator(name) {
    let check = true;
    if (!name.trim()) {
      $("#error_name").text("Vui lòng nhập tên tiêu chí");
      check = false;
    } else {
      $("#error_name").text("");
      check = true;
    }
    return check;
  }
</script>
@endpush
