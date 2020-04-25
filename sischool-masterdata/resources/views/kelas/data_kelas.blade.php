@extends('layouts.app')

@section('content')
 <!-- BEGIN CONTENT -->
 <div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-id icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Data Kelas
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
                    <b>Info!</b> Halaman data kelas adalah halaman yang menampilkan kelas yang terdaftar pada sistem. <br> 
                    Anda dapat menambahkan, mengubah (edit), atau menghapus kelas yang ada. <br> 
                    Data yang terdaftar pada sistem akan terhubung dengan data yang lain.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card mb-3 widget-content bg-grow-early">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Kelas</div>
                            <div class="widget-subheading">Kelas yang terdaftar</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{count($kelas)}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target=".tambah-kelas"><i class="fa fa-plus"></i> Tambah Data Kelas</button>
            </div>
        </div>

        <!-- <div class="row mb-3">
            <div class="col-md-6">
                <select name="filter_jurusan" id="filter_jurusan" class="form-control">
                    <option value="0">Filter Jurusan</option>
                    <option value="IPA">IPA</option>
                    <option value="IPS">IPS</option>
                    <option value="BAHASA">BAHASA</option>
                </select>
            </div>
            <div class="col-md-6">
                <select name="filter_tingkat" id="filter_tingkat" class="form-control">
                    <option value="0">Filter Tingkatan</option>
                    @foreach($jenjang as $rj)
                        <option value="{{ $rj->level }}">{{ $rj->level }}</option>
                    @endforeach
                </select>
            </div>
        </div> -->

        <div class="row">
            <div class="col-md-12 col-lg-12 col-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Data Kelas</h5>

                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="kelas-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Kode Kelas</th>
                                                <th>Nama Kelas</th>
                                                <th>Tingkat</th>
                                                <th>Jurusan</th>
                                                <th>Wali Kelas</th>
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
<!-- END CONTENT -->

<form id="form-delete">
    @csrf
    @method('delete')
    <input type="hidden" name="id_kelas" id="id-kelas">
</form>
@endsection

@section('modal')
<div class="modal fade tambah-kelas" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="tambah-kelas">
                @csrf()
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="kode_kelas" class="">Kode Kelas</label>
                                <input name="kode_kelas" id="kode_kelas" placeholder="Kode Kelas" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="nama_kelas" class="">Nama Kelas</label>
                                <input name="nama_kelas" id="nama_kelas" placeholder="Nama Kelas" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="tingkat_kelas" class="">Tingkatan Kelas</label>
                                <select name="tingkat_kelas" id="tingkat_kelas" class="form-control">
                                    <option value="">Tingkat Kelas</option>
                                    @foreach($jenjang as $rj)
                                        <option value="{{ $rj->level }}">{{ $rj->level }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="jurusan_kelas" class="">Jurusan</label>
                                <select name="jurusan_kelas" id="jurusan_kelas" class="form-control">
                                    <option value="">Jurusan</option>
                                    <option value="IPA">IPA</option>
                                    <option value="IPS">IPS</option>
                                    <option value="BAHASA">BAHASA</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="position-relative form-check">
                        <input name="check" type="checkbox" class="form-check-input pilih-walikelas">
                        <label for="pilih-walikelas" class="form-check-label">Pilih wali kelas untuk kelas ini</label>
                    </div>
                    <div class="form-row mt-3 select-walikelas" style="display:none;">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="wali_kelas" class="">Pilih Wali Kelas</label>
                                <select name="wali_kelas" id="wali_kelas" class="form-control">
                                    <option value="">Wali Kelas</option>
                                    @foreach($guru as $rg)
                                        <option value="{{ $rg->id }}">{{ $rg->nama_guru }}</option>
                                    @endforeach
                                </select>
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

<button id="edit-kelas-btn" data-toggle="modal" data-target=".edit-kelas" style="display:none;"></button>
<div class="modal fade edit-kelas" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Kelas <span id="judul-kelas"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="edit-kelas">
                @csrf()
                @method('patch')
                <input type="hidden" name="id_kelas" id="id_kelas_edit">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="kode_kelas_edit" class="">Kode Kelas</label>
                                <input name="kode_kelas" id="kode_kelas_edit" placeholder="Kode Kelas" type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="nama_kelas_edit" class="">Nama Kelas</label>
                                <input name="nama_kelas" id="nama_kelas_edit" placeholder="Nama Kelas" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="tingkat_kelas_edit" class="">Tingkatan Kelas</label>
                                <select name="tingkat_kelas" id="tingkat_kelas_edit" class="form-control">
                                    <option value="">Tingkat Kelas</option>
                                    @foreach($jenjang as $rj)
                                        <option value="{{ $rj->level }}">{{ $rj->level }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="jurusan_kelas_edit" class="">Jurusan</label>
                                <select name="jurusan_kelas" id="jurusan_kelas_edit" class="form-control">
                                    <option value="">Jurusan</option>
                                    <option value="IPA">IPA</option>
                                    <option value="IPS">IPS</option>
                                    <option value="BAHASA">BAHASA</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="position-relative form-check">
                        <input name="check" id="" type="checkbox" class="form-check-input pilih-walikelas">
                        <label for="pilih-walikelas" class="form-check-label">Pilih wali kelas untuk kelas ini</label>
                    </div>
                    <div class="form-row mt-3 select-walikelas" style="display:none;">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="wali_kelas" class="">Pilih Wali Kelas</label>
                                <select name="wali_kelas" id="wali_kelas_edit" class="form-control">
                                    <option value="">Wali Kelas</option>
                                    @foreach($guru as $rg)
                                        <option value="{{ $rg->id }}">{{ $rg->nama_guru }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('#kelas-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{url("kelas/ajax_get_kelas")}}',
        aoColumns: [
            {
                "data": "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "kode_kelas" },
            { "data": "nama_kelas" },
            { "data": "tingkat_kelas" },
            { "data": "jurusan_kelas" },
            {
                "mData": "guru.nama_guru",
                "mRender": function (data, type, row) {
                    var html = ``;
                    if(data != null){
                        html += data;
                    }else{
                        html += `
                            <div class="badge badge-info">Belum diatur wali kelas</div>
                        `;
                    }

                    return html;
                }
            },
            {
                "mData": "id",
                "mRender": function (data, type, row) {
                    var html = `
                        <button class="btn btn-sm btn-success" onclick="editKelas(`+ data +`)"><i class="fa fa-edit"></i> Ubah</button>
                        <button class="btn btn-sm btn-danger" onclick="deleteKelas(`+ data +`)"><i class="fa fa-trash"></i> Hapus</button>
                    `;
                    return html;
                }
            }
        ]
    });

    $(".pilih-walikelas").on('change', function(){
        if($(this).is(':checked')){
            $(".select-walikelas").slideDown();
        }else{
            $(".select-walikelas").slideUp();
        }
    });
    $("#tambah-kelas").submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();

        $.ajax({
            url: '{{ url("kelas") }}',
            method: 'POST',
            data: data,
            dataType: 'json',
            beforeSend: function(){
                $(".loader").show();
            },
            success: function(response){
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
            error: function(){
                alert('Error Data!');
            }
        });
    });

    $("#edit-kelas").submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();
        
        $.ajax({
            url: '{{ url("kelas") }}',
            method: 'POST',
            data: data,
            dataType: 'json',
            beforeSend: function(){
                $(".loader").show();
            },
            success: function(response){
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
            error: function(){
                alert('Error Data!');
            }
        });
    });
    
    function deleteKelas(id){
        Swal.fire({
            title: 'Apakah anda ingin menghapus ?',
            text: "Anda akan yakin akan menghapus data kelas ini",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#f5365c',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                // form-delete
                $("#id-kelas").val(id);
                var data = $("#form-delete").serialize();
                $.ajax({
                    url: '{{ url("kelas") }}',
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
                                'error  '
                            );

                            //window.location.href = response.redirect;
                        }
                    },
                    error: function(){
                        alert('Error Data!');
                    }
                });
            }
        })
    }

    function editKelas(id)
    {  
        $.ajax({
            url: '{{ url("kelas/ajax_get_kelas_by_id") }}',
            method: 'GET',
            data: {id: id},
            dataType: 'json',
            beforeSend: function(){
                $(".loader").show();
            },
            success: function(response){
                $(".loader").hide();
                $("#edit-kelas-btn").trigger('click');
                $("#judul-kelas").html(response.data.nama_kelas);
                $("#kode_kelas_edit").val(response.data.kode_kelas);
                $("#nama_kelas_edit").val(response.data.nama_kelas);
                $("#tingkat_kelas_edit").val(response.data.tingkat_kelas);
                $("#jurusan_kelas_edit").val(response.data.jurusan_kelas);
                $("#wali_kelas_edit").val(response.data.wali_kelas);
                $("#id_kelas_edit").val(response.data.id);
                $("#wali_kelas_edit").val(response.data.wali_kelas);

                if(response.data.wali_kelas != null && response.data.wali_kelas != 0)
                {
                    $(".pilih-walikelas").prop('checked', true);
                    $(".select-walikelas").css('display', 'block');
                }else{
                    $(".pilih-walikelas").prop('checked', false);
                    $(".select-walikelas").css('display', 'none');
                }
            },
            error: function(){
                alert('Error Data!');
            }
        });
    }
</script>
@endsection