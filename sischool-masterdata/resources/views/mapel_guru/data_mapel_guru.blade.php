@extends('layouts.app')

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Data Mata Pelajaran Guru
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
                    <b>Info!</b> Halaman data mata pelajaran guru adalah halaman yang menampilkan mata pelajaran guru yang terdaftar pada sistem. <br> 
                    Anda dapat menambahkan, dan menghapus mata pelajaran guru yang ada. <br> 
                    Data yang terdaftar pada sistem akan terhubung dengan data yang lain.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card mb-3 widget-content bg-grow-early">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Mata Pelajaran Guru</div>
                            <div class="widget-subheading">Mata Pelajaran Guru yang terdaftar</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span></span></div>
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
                        <h5 class="card-title">Data Mata Pelajaran Guru</h5>

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
                                                <th>KKM</th>
                                                <th>Nama Guru</th>
                                                <th>NIP</th>
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
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="guru_id" class="">Pilih Guru <span class="text-danger">*</span></label> 
                                <select name="guru_id" id="guru_id" class="form-control">
                                    <option value="">Pilih Guru</option>
                                    @foreach($gurus as $guru)
                                    <option value="{{$guru->id}}">{{$guru->nama_guru}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Pilih Mapel <span class="text-danger">*</span></label> 
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Mapel</th>
                                            <th>Nama Mapel</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mapels as $mapel)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="mapel_id[]" value="{{$mapel->id}}">
                                            </td>
                                            <td>
                                                {{$mapel->kode_mapel}}
                                            </td>
                                            <td>
                                                {{$mapel->nama_mapel}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="kkm" class="">KKM <span class="text-danger">*</span></label> 
                                <input type="number" class="form-control" id="kkm" name="kkm" placeholder="Masukkan KKM Mata Pelajaran">
                            </div>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Mapel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="edit-mapel">
                @csrf()
                @method('PATCH')
                <input type="hidden" name="id" id="id-guru">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="guru_id_edit" class="">Pilih Guru <span class="text-danger">*</span></label> 
                                <select name="guru_id" id="guru_id_edit" class="form-control">
                                    <option value="">Pilih Guru</option>
                                    @foreach($gurus as $guru)
                                    <option value="{{$guru->id}}">{{$guru->nama_guru}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Pilih Mapel <span class="text-danger">*</span></label> 
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Mapel</th>
                                            <th>Nama Mapel</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mapels as $mapel)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="mapel_id[]" value="{{$mapel->id}}" class="mapel_id_edit">
                                            </td>
                                            <td>
                                                {{$mapel->kode_mapel}}
                                            </td>
                                            <td>
                                                {{$mapel->nama_mapel}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="kkm_edit" class="">KKM <span class="text-danger">*</span></label> 
                                <input type="number" class="form-control" id="kkm_edit" name="kkm" placeholder="Masukkan KKM Mata Pelajaran">
                            </div>
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
        ajax: '{{url("mapel_guru/ajax_get_mapel")}}',
        aoColumns: [
            {
                "data": "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "mapel.kode_mapel" },
            { "data": "mapel.nama_mapel" },
            { "data": "mapel.kelompok_mapel" },
            { "data": "kkm" },
            { "data": "guru.nama_guru" },
            { "data": "guru.nip_guru" },
            {
                "data": "id",
                "render": function (data, type, row) {
                    var html = `
                        <button class="btn btn-sm btn-danger" onclick="deleteMapel(`+ data +`)"><i class="fa fa-trash"></i> Hapus</button>
                    `;
                    return html;
                }
            }
        ]
    });

    $("#tambah-mapel").submit(function(e)
    {   
        e.preventDefault();
        var data = $(this).serialize();

        $.ajax({
            url: '{{url("mapel_guru")}}',
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
                alert('Error Data!');
            }
        });
    });

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
                    url: '{{ url("mapel_guru") }}',
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
