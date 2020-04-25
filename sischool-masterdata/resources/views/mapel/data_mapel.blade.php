@extends('layouts.app')

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-bookmarks icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Data Mata Pelajaran
                        <div class="page-title-subheading">
                            <?=date("l, d F Y") ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>  

        <div class="row">
            <div class="col-md-12 col-lg-12 col-12">
                <div class="alert alert-info">
                    <b>Info!</b> Halaman data mata pelajaran adalah halaman yang menampilkan mata pelajaran yang terdaftar pada sistem. <br> 
                    Anda dapat menambahkan, mengubah (edit), atau menghapus mata pelajaran yang ada. <br> 
                    Data yang terdaftar pada sistem akan terhubung dengan data yang lain.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card mb-3 widget-content bg-grow-early">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Mata Pelajaran</div>
                            <div class="widget-subheading">Mata Pelajaran yang terdaftar</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{count($mapel)}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target=".tambah-mapel"><i class="fa fa-plus"></i> Tambah Data Mapel</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Data Mata Pelajaran</h5>

                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="my-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Kode Mapel</th>
                                                <th>Nama Mapel</th>
                                                <th>Kelompok Mapel</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="form-delete">
    @csrf
    @method('delete')
    <input type="hidden" name="id" id="id-mapel">
</form>
@endsection

@section('modal')
<div class="modal fade tambah-mapel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Mapel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="tambah-mapel">
                @csrf()
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="kode_mapel" class="">Kode Mapel <span class="text-danger">*</span></label> 
                                <input name="kode_mapel" id="kode_mapel" placeholder="Kode Mapel" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="nama_mapel" class="">Nama Mapel <span class="text-danger">*</span></label>
                                <input name="nama_mapel" id="nama_mapel" placeholder="Nama Mapel" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="kelompok_mapel" class="">Pilih Kelompok Mapel</label>
                            <select name="kelompok_mapel" id="kelompok_mapel" class="form-control">
                                <option value="">Pilih Kelompok Mapel</option>
                                <option value="-">-</option>
                                <option value="UMUM">UMUM</option>
                                <option value="PENJURUSAN">PENJURUSAN</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<button class="btn btn-primary btn-block" data-toggle="modal" id="show-modal-edit" data-target=".edit-mapel" style="display:none;"><i class="fa fa-plus"></i> Tambah Data Mapel</button>

<div class="modal fade edit-mapel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Mapel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="edit-mapel">
                @csrf()
                @method('patch')
                <input type="hidden" name="id" id="id-edit">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="kode_mapel" class="">Kode Mapel <span class="text-danger">*</span></label> 
                                <input name="kode_mapel" id="kode_mapel_edit" placeholder="Kode Mapel" type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="nama_mapel" class="">Nama Mapel <span class="text-danger">*</span></label>
                                <input name="nama_mapel" id="nama_mapel_edit" placeholder="Nama Mapel" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="kelompok_mapel" class="">Pilih Kelompok Mapel</label>
                            <select name="kelompok_mapel" id="kelompok_mapel_edit" class="form-control">
                                <option value="">Pilih Kelompok Mapel</option>
                                <option value="-">-</option>
                                <option value="UMUM">UMUM</option>
                                <option value="PENJURUSAN">PENJURUSAN</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $("#my-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{url("mapel/ajax_get_mapel")}}',
        aoColumns: [
            {
                "data": "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "kode_mapel" },
            { "data": "nama_mapel" },
            { "data": "kelompok_mapel" },
            {
                "data": "id",
                "render": function (data, type, row) {
                    var html = `
                        <button class="btn btn-sm btn-success" onclick="editMapel(`+ data +`)"><i class="fa fa-edit"></i> Ubah</button>
                        <button class="btn btn-sm btn-danger" onclick="deleteMapel(`+ data +`)"><i class="fa fa-trash"></i> Hapus</button>
                    `;
                    return html;
                }
            }
        ]
    });

    $("#tambah-mapel").submit(function(e){
        e.preventDefault();

        var data = $(this).serialize();

        $.ajax({
            url: '{{url("mapel/ajax_action_add_mapel")}}',
            method: 'POST',
            data: data,
            dataType: 'json',
            beforeSend: function()
            {
                $(".loader").show();
            },
            success: function(response)
            {
                $(".loader").hide();

                if(response.result == false)
                {
                    var form_error = response.form_error;
                    if(form_error.length > 0){
                        for(i = 0; i < form_error.length; i++){
                            toastr.error(form_error[i], response.message.head);
                        }
                    }else{
                        Swal.fire(
                            response.message.head,
                            response.message.body,
                            'error'
                        );
                    }
                }

                if(response.result == true){
                    Swal.fire(
                        response.message.head,
                        response.message.body,
                        'success'
                    );

                    window.location.href = response.redirect;
                }
            },
            error: function()
            {
                $(".loader").hide();
                alert('Error Data!');
            }
        });
    });

    $("#edit-mapel").submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();

        $.ajax({
            url: '{{ url("mapel") }}',
            method: 'POST',
            data: data,
            dataType: 'json',
            beforeSend: function ()
            {
                $(".loader").show();
            },
            success: function(response)
            {
                $(".loader").hide();

                if(response.result == false)
                {
                    var form_error = response.form_error;
                    if(form_error.length > 0){
                        for(i = 0; i < form_error.length; i++){
                            toastr.error(form_error[i], response.message.head);
                        }
                    }else{
                        Swal.fire(
                            response.message.head,
                            response.message.body,
                            'error'
                        );
                    }
                }

                if(response.result == true){
                    Swal.fire(
                        response.message.head,
                        response.message.body,
                        'success'
                    );

                    window.location.href = response.redirect;
                }
            },
            error: function()
            {
                alert('Error Data!');
            }
        });
    });

    function editMapel(id)
    {
        $.ajax({
            url: '{{ url("mapel/ajax_get_mapel_by_id") }}',
            method: 'GET',
            data:{
                id: id
            },
            dataType: 'json',
            beforeSend: function()
            {
                $(".loader").show();
            },
            success: function(response)
            {
                $(".loader").hide();
                $("#id-edit").val(response.data.id);
                $("#kode_mapel_edit").val(response.data.kode_mapel);
                $("#nama_mapel_edit").val(response.data.nama_mapel);
                $("#kelompok_mapel_edit").val(response.data.kelompok_mapel);
                $("#show-modal-edit").click();
            },
            error: function()
            {
                $(".loader").hide();
                alert('Error Data!');
            }
        });
    }

    function deleteMapel(id)
    {  
        Swal.fire({
            title: 'Apakah anda ingin menghapus ?',
            text: "Anda akan yakin akan menghapus data mapel ini",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#f5365c',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                // form-delete
                $("#id-mapel").val(id);
                var data = $("#form-delete").serialize();
                $.ajax({
                    url: '{{ url("mapel") }}',
                    method: 'POST',
                    data: data,
                    dataType: 'json',
                    beforeSend: function(){
                        $(".loader").show();
                    },
                    success: function(response){
                        $(".loader").hide();
                        if(response.result == true){
                            Swal.fire(
                                response.message.head,
                                response.message.body,
                                'success'
                            );

                            window.location.href = response.redirect;
                        }else{
                            Swal.fire(
                                response.message.head,
                                response.message.body,
                                'error'
                            );

                            //window.location.href = response.redirect;
                        }
                    },
                    error: function(){
                        alert('Error Data!');
                    }
                });
            }
        });
    }
</script>
@endsection