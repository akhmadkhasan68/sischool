@extends('layouts.app')

@section('content')
 <!-- BEGIN CONTENT -->
 <div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Data Siswa
                        <div class="page-title-subheading">
                            Data siswa terdaftar pada sistem {{ config('app.name') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        
        <div class="row">
            <div class="col-md-12 col-lg-12 col-12">
                <div class="alert alert-info">
                    <b>Info!</b> Halaman data siswa adalah halaman yang menampilkan siswa yang terdaftar pada sistem. <br> 
                    Anda dapat menambahkan, mengubah (edit), atau menghapus siswa yang ada. <br> 
                    Data yang terdaftar pada sistem akan terhubung dengan data yang lain.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card mb-3 widget-content bg-grow-early">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Siswa</div>
                            <div class="widget-subheading">Siswa yang terdaftar</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{count($siswa)}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target=".tambah-siswa"><i class="fa fa-plus"></i> Tambah Siswa</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Data Siswa</h5>

                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="my-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>NIS</th>
                                                <th>NISN</th>
                                                <th>Kelas</th>
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
    <input type="hidden" name="id" id="id-siswa">
</form>
@endsection

@section('modal')
<div class="modal fade tambah-siswa" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="tambah-siswa">
                @csrf()
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="nama_siswa" class="">Nama <span class="text-danger">*</span></label> 
                                <input name="nama_siswa" id="nama_siswa" placeholder="Nama Siswa" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="nisn_siswa" class="">NISN <span class="text-danger">*</span></label>
                                <input name="nisn_siswa" id="nisn_siswa" placeholder="NISN Siswa" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="nis_siswa" class="">NIS <span class="text-danger">*</span></label>
                                <input name="nis_siswa" id="nis_siswa" placeholder="NIS Siswa" type="number" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"> 
                                <label for="tempat_lahir_siswa" class="">Tempat Lahir</label> <label class="text-danger">*</label>
                                <input name="tempat_lahir_siswa" id="tempat_lahir_siswa" placeholder="Kota/Kabupaten Lahir Siswa" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"> 
                                <label for="tgl_lahir_siswa" class="">Tanggal Lahir</label> <label class="text-danger">*</label>
                                <input name="tgl_lahir_siswa" id="tgl_lahir_siswa" placeholder="Tanggal Lahir Siswa" type="date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="agama_siswa" class="">Agama <span class="text-danger">*</span></label>
                                <select name="agama_siswa" id="agama_siswa" class="form-control">
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen Katolik">Kristen Katolik</option>
                                    <option value="Kristen Protestan">Kristen Protestan</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="jk_siswa" class="">Jenis Kelamin <span class="text-danger">*</span></label>
                                <br>
                                <input type="radio" name="jk_siswa" id="jk_siswa1" value="L"> Laki-laki &nbsp;
                                <input type="radio" name="jk_siswa" id="jk_siswa2" value="P"> Perempuan
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="kelas_id">Kelas Siswa <span class="text-danger">*</span></label>
                                <select name="kelas_id" id="kelas_id" class="form-control">
                                    @foreach($kelas as $rk)
                                        <option value="{{ $rk->id }}">{{ $rk->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="username" class="">Username <span class="text-danger">*</span></label>
                                <input name="username" id="username" placeholder="Username Siswa" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="password" class="">Password <span class="text-danger">*</span></label>
                                <input name="password" id="password" placeholder="Password Siswa" type="password" class="form-control">
                                <input type="checkbox" id="password-nis" class="mt-2"> Password samakan dengan NIS
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="no_siswa" class="">Nomor Telepon <span class="text-danger">*</span></label>
                                <input name="no_siswa" id="no_siswa" placeholder="Nomor Telepon Siswa" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="email" class="">Email <span class="text-danger">*</span></label>
                                <input name="email" id="email" placeholder="Email Siswa" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="alamat_siswa" class="">Alamat</label> <label class="text-danger">*</label>
                                <textarea name="alamat_siswa" id="alamat_siswa" cols="30" rows="5" class="form-control" placeholder="Masukkan alamat lengkap siswa"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group"> 
                                <label for="kota_siswa" class="">Kota/Kabupaten</label> <label class="text-danger">*</label>
                                <input name="kota_siswa" id="kota_siswa" placeholder="Kota/Kabupaten Siswa" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="foto_siswa" class="">Foto</label>
                                <input type="file" name="foto_siswa" class="form-control" id="foto_siswa">
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

<button class="btn btn-primary btn-block" data-toggle="modal" data-target=".detail-siswa" id="detail-button" style="display:none;"><i class="fa fa-plus"></i> Detail Data siswa</button>

<div class="modal fade detail-siswa" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Detail Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="body-detail">
                
            </div>
        </div>
    </div>
</div>

<button class="btn btn-primary btn-block" data-toggle="modal" data-target=".edit-siswa" id="edit-button" style="display:none;"><i class="fa fa-edit"></i> Edit Data Guru</button>

<div class="modal fade edit-siswa" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="edit-siswa">
                @csrf()
                @method('patch')
                <input type="hidden" name="id" id="id_siswa">
                <input type="hidden" name="user_id" id="user_id">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="nama_siswa_edit" class="">Nama <span class="text-danger">*</span></label> 
                                <input name="nama_siswa" id="nama_siswa_edit" placeholder="Nama Siswa" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="nisn_siswa_edit" class="">NISN <span class="text-danger">*</span></label>
                                <input name="nisn_siswa" id="nisn_siswa_edit" placeholder="NISN Siswa" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="nis_siswa_edit" class="">NIS <span class="text-danger">*</span></label>
                                <input name="nis_siswa" id="nis_siswa_edit" placeholder="NIS Siswa" type="number" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"> 
                                <label for="tempat_lahir_siswa_edit" class="">Tempat Lahir</label> <label class="text-danger">*</label>
                                <input name="tempat_lahir_siswa" id="tempat_lahir_siswa_edit" placeholder="Kota/Kabupaten Lahir Siswa" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"> 
                                <label for="tgl_lahir_siswa_edit" class="">Tanggal Lahir</label> <label class="text-danger">*</label>
                                <input name="tgl_lahir_siswa" id="tgl_lahir_siswa_edit" placeholder="Tanggal Lahir Siswa" type="date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="agama_siswa_edit" class="">Agama <span class="text-danger">*</span></label>
                                <select name="agama_siswa" id="agama_siswa_edit" class="form-control">
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen Katolik">Kristen Katolik</option>
                                    <option value="Kristen Protestan">Kristen Protestan</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="jk_siswa" class="">Jenis Kelamin <span class="text-danger">*</span></label>
                                <br>
                                <input type="radio" name="jk_siswa" id="jk_siswa_edit_1" value="L"> Laki-laki &nbsp;
                                <input type="radio" name="jk_siswa" id="jk_siswa_edit_2" value="P"> Perempuan
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="kelas_id_edit">Kelas Siswa <span class="text-danger">*</span></label>
                                <select name="kelas_id" id="kelas_id_edit" class="form-control">
                                    @foreach($kelas as $rk)
                                        <option value="{{ $rk->id }}">{{ $rk->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="username_edit" class="">Username <span class="text-danger">*</span></label>
                                <input name="username" id="username_edit" placeholder="Username Siswa" type="text" class="form-control readonly" disabled>
                                <input type="checkbox" id="ubah_username" class="mt-2"> Ubah Username
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="password_edit" class="">Password <span class="text-danger">*</span></label>
                                <input name="password" id="password_edit" placeholder="Password Siswa" type="password" class="form-control readonly" disabled>
                                <input type="checkbox" id="ubah_password" class="mt-2"> Ubah Password
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="no_siswa_edit" class="">Nomor Telepon <span class="text-danger">*</span></label>
                                <input name="no_siswa" id="no_siswa_edit" placeholder="Nomor Telepon Siswa" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="email_edit" class="">Email <span class="text-danger">*</span></label>
                                <input name="email" id="email_edit" placeholder="Email Siswa" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="alamat_siswa_edit" class="">Alamat</label> <label class="text-danger">*</label>
                                <textarea name="alamat_siswa" id="alamat_siswa_edit" cols="30" rows="5" class="form-control" placeholder="Masukkan alamat lengkap siswa"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group"> 
                                <label for="kota_siswa_edit" class="">Kota/Kabupaten</label> <label class="text-danger">*</label>
                                <input name="kota_siswa" id="kota_siswa_edit" placeholder="Kota/Kabupaten Siswa" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <input type="checkbox" name="change_photo" id="change-photo" class="my-2"> Ubah Foto Siswa
                    <div class="form-row" id="change-photo-display" style="display:none;">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="foto_siswa" class="">Foto</label>
                                <input type="file" name="foto_siswa" class="form-control" id="foto_siswa_edit">
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
        ajax: '{{url("siswa/ajax_get_siswa")}}',
        aoColumns: [
            {
                "data": "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "nama_siswa" },
            { "data": "nis_siswa" },
            { "data": "nisn_siswa" },
            { "data": "kelas.nama_kelas" },
            { "data": function (data, type, dataToSet) {
                var html = `
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="detail(`+ data.id +`)"><i class="fa fa-info"></i> Detail</button>
                        <button class="btn btn-success btn-sm" onclick="edit(`+ data.id +`)"><i class="fa fa-edit"></i> Ubah</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteSiswa(`+ data.user_id +`)"><i class="fa fa-trash"></i> Hapus</button>
                    </td>
                `;
                return html;
                }
            }
        ]
    });

    $("#tambah-siswa").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '{{ url("siswa") }}',
            method:"post",
            dataType: 'json',
            data:new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            beforeSend: function(){
                $(".loader").show();
            },
            success: function(response){
                $(".loader").hide();
                
                if(response.result == false)
                {
                    var form_error = response.form_error;
                    if(form_error.length != 0){
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
                alert("Error Data!");
            }
        });
    });

    $("#edit-siswa").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '{{ url("siswa") }}',
            method:"post",
            dataType: 'json',
            data:new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            beforeSend: function(){
                $(".loader").show();
            },
            success: function(response){
                $(".loader").hide();
                
                if(response.result == false)
                {
                    var form_error = response.form_error;
                    if(form_error.length != 0){
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
                alert("Error Data!");
            }
        });
    });

    $("#password-nis").change(function(){
        if($(this).is(":checked"))
        {
            var nis = $("#nis_siswa").val();
            $("#password").val(nis);
        }
        else
        {
            $("#password").val("");
        }
    });

    $("#change-photo").on('change', function(){
        if ($(this).is(':checked')) {
            $("#change-photo-display").slideDown();
        }else{
            $("#change-photo-display").slideUp();
        }
    });

    $("#ubah_username").change(function()
    {
        if($(this).is(":checked"))
        {
            $("#username_edit").prop( "disabled", false);
            $("#username_edit").removeClass('readonly');
        }
        else
        {
            $("#username_edit").prop( "disabled", true);
            $("#username_edit").addClass('readonly');
        }
    });

    $("#ubah_password").change(function()
    {
        if ($(this).is(':checked')) {
            $("#password_edit").prop( "disabled", false);
            $("#password_edit").removeClass('readonly');
        }else{
            $("#password_edit").prop( "disabled", true);
            $("#password_edit").addClass('readonly');
        }
    });

    function detail(id)
    {
        $.ajax({
            url: '{{ url("siswa/ajax_get_siswa_by_id") }}',
            method: 'GET',
            data: {id: id},
            dataType: 'json',
            beforeSend: function(){
                $(".loader").show();
            },
            success: function(response){
                $(".loader").hide();
                
                if(response.data.foto_siswa != ""){
                    var images =  'uploads/photos/' + response.data.foto_siswa;
                }else{
                    var images =  'images/avatars/default.jpg';
                }

                if(response.data.jk_siswa == "L"){
                    var jenkel = 'Laki-laki';
                }else{
                    var jenkel = 'Perempuan';
                }

                const d = new Date(response.data.tgl_lahir_siswa)
                const ye = new Intl.DateTimeFormat('id', { year: 'numeric' }).format(d)
                const mo = new Intl.DateTimeFormat('id', { month: 'long' }).format(d)
                const da = new Intl.DateTimeFormat('id', { day: '2-digit' }).format(d)

                var tgl = `${da} ${mo} ${ye}`;

                var html = `
                <div class="row">
                    <div class="col-md-7 mr-md-auto my-2">
                        <b>Nama:</b> `+ response.data.nama_siswa +`
                        <br>
                        <b>TTL:</b> `+ response.data.tempat_lahir_siswa +`, `+ tgl +`
                        <br>
                        <b>NIS:</b> `+ response.data.nis_siswa +`
                        <br>
                        <b>NISN:</b> `+ response.data.nisn_siswa +`
                        <br>
                        <b>Jenis Kelamin:</b> `+ jenkel +`
                        <br>
                        <b>Agama:</b> `+ response.data.agama_siswa +`
                        <br>
                        <b>Kelas:</b> `+ response.data.kelas.nama_kelas +`
                        <br>
                        <b>Nomor Telepon:</b> `+ response.data.no_siswa +`
                        <br>
                        <b>Email:</b> `+ response.data.user.email +`
                        <br>
                        <b>Username:</b> `+ response.data.user.username +`
                        <br>
                        <b>Alamat:</b> `+ response.data.alamat_siswa +`
                        <br>
                        <b>Kota/Kabupaten:</b> `+ response.data.kota_siswa +`
                    </div>
                    <div class="col-md-5 ml-md-auto">
                        <div class="main-card my-2 card">
                            <div class="card-body">
                                <img src="`+ images +`" class="rounded img-fluid img-thumbnail">
                            </div>
                        </div>
                    </div>
                </div>
                `;

                $("#detail-button").click();
                $("#body-detail").html(html);
            },
            error: function(){
                alert('Error Data!');
            }
        });
    }

    function edit(id)
    {
        $.ajax({
            url: '{{ url("siswa/ajax_get_siswa_by_id") }}',
            method: 'GET',
            data: {id: id},
            dataType: 'json',
            beforeSend: function(){
                $(".loader").show();
            },
            success: function(response){
                $(".loader").hide();
                
                $("#edit-button").click();

                $("#id_siswa").val(response.data.id);
                $("#user_id").val(response.data.user_id);
                $("#nama_siswa_edit").val(response.data.nama_siswa);
                $("#nis_siswa_edit").val(response.data.nis_siswa);
                $("#nisn_siswa_edit").val(response.data.nisn_siswa);
                $("#tempat_lahir_siswa_edit").val(response.data.tempat_lahir_siswa);
                $("#tgl_lahir_siswa_edit").val(response.data.tgl_lahir_siswa);
                $("#agama_siswa_edit").val(response.data.agama_siswa);
                if(response.data.jk_siswa == "L")
                {
                    $("#jk_siswa_edit_1").prop('checked', true);
                }else{
                    $("#jk_siswa_edit_2").prop('checked', true);
                }
                $("#kelas_id_edit").val(response.data.kelas_id);
                $("#username_edit").val(response.data.user.username);
                $("#no_siswa_edit").val(response.data.no_siswa);
                $("#email_edit").val(response.data.user.email);
                $("#alamat_siswa_edit").val(response.data.alamat_siswa);
                $("#kota_siswa_edit").val(response.data.kota_siswa);
            },
            error: function(){
                alert('Error Data!');
            }
        });
    }

    function deleteSiswa(id)
    {
        Swal.fire({
            title: 'Apakah anda ingin menghapus ?',
            text: "Anda akan yakin akan menghapus data siswa ini",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#f5365c',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                // form-delete
                $("#id-siswa").val(id);
                var data = $("#form-delete").serialize();
                $.ajax({
                    url: '{{ url("siswa") }}',
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
