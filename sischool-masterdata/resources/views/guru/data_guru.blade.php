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
                    <div>Data Guru
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
                    <b>Info!</b> Halaman data guru adalah halaman yang menampilkan guru yang terdaftar pada sistem. <br> 
                    Anda dapat menambahkan, mengubah (edit), atau menghapus guru yang ada. <br> 
                    Data yang terdaftar pada sistem akan terhubung dengan data yang lain.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card mb-3 widget-content bg-grow-early">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Guru</div>
                            <div class="widget-subheading">Guru yang terdaftar</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ $count }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target=".tambah-guru"><i class="fa fa-plus"></i> Tambah Data Guru</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12 col-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Data Guru</h5>

                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="table-responsive">
                                    <table class="table table-">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>NIP</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Nomor Telepon</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1 ?>
                                            @foreach($result as $row)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $row->nama_guru }}</td>
                                                <td>{{ $row->nip_guru }}</td>
                                                <td>
                                                    @if($row->jk_guru == "L")
                                                        Laki - laki
                                                    @else
                                                        Perempuan
                                                    @endif
                                                </td>
                                                <td>{{ $row->no_guru }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" onclick="detail({{ $row->id }})"><i class="fa fa-info"></i> Detail</button>
                                                    <button class="btn btn-success btn-sm" onclick="edit({{ $row->id }})"><i class="fa fa-edit"></i> Ubah</button>
                                                    <button class="btn btn-danger btn-sm" onclick="hapus({{ $row->user_id }})"><i class="fa fa-trash"></i> Hapus</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
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
    <input type="hidden" name="id" id="id-user">
</form>
@endsection

@section('modal')
<div class="modal fade tambah-guru" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Guru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="tambah-guru">
                @csrf()
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="nama_guru" class="">Nama</label> <label class="text-danger">*</label>
                                <input name="nama_guru" id="nama_guru" placeholder="Nama" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="nip_guru" class="">NIP</label> <label class="text-danger">*</label>
                                <input name="nip_guru" id="nip_guru" placeholder="NIP Guru" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="jk_guru" class="">Jenis Kelamin</label> <label class="text-danger">*</label><br>
                                <input type="radio" name="jk_guru" value="L"> Laki - laki &nbsp; <input type="radio" name="jk_guru" value="P"> Perempuan
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="username" class="">Username</label> <label class="text-danger">*</label>
                                <input name="username" id="username" placeholder="Username" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="password" class="">Password</label> <label class="text-danger">*</label>
                                <input name="password" id="password" placeholder="Password" type="password" class="form-control">
                                <input type="checkbox" id="password-nip" class="mt-2"> Password samakan dengan NIP
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="username" class="">Email</label> <label class="text-danger">*</label>
                                <input name="email" id="email" placeholder="Email" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="no_guru" class="">Nomor Telepon</label> <label class="text-danger">*</label>
                                <input name="no_guru" id="no_guru" placeholder="Nomor Telepon" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="alamat_guru" class="">Alamat</label> <label class="text-danger">*</label>
                                <textarea name="alamat_guru" id="alamat_guru" cols="30" rows="5" class="form-control" placeholder="Masukkan alamat lengkap guru"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group"> 
                                <label for="kota_guru" class="">Kota/Kabupaten</label> <label class="text-danger">*</label>
                                <select name="kota_guru" id="kota_guru" class="form-control">
                                    <option value="">Kota/Kabupaten</option>
                                    <option value="Malang">Malang</option>
                                    <option value="Kabupaten Malang">Kabupaten Malang</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="foto_guru" class="">Foto</label>
                                <input type="file" name="foto_guru" class="form-control" id="foto_guru">
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

<button class="btn btn-primary btn-block" data-toggle="modal" data-target=".detail-guru" id="detail-button" style="display:none;"><i class="fa fa-plus"></i> Detail Data Guru</button>

<div class="modal fade detail-guru" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Detail Guru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="body-detail">
                
            </div>
        </div>
    </div>
</div>

<button class="btn btn-primary btn-block" data-toggle="modal" data-target=".edit-guru" id="edit-button" style="display:none;"><i class="fa fa-edit"></i> Edit Data Guru</button>

<div class="modal fade edit-guru" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Guru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="edit-guru">
                @csrf()
                @method('patch')
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="nama_guru_edit" class="">Nama</label> <label class="text-danger">*</label>
                                <input name="nama_guru" id="nama_guru_edit" placeholder="Nama" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="nip_guru_edit" class="">NIP</label> <label class="text-danger">*</label>
                                <input name="nip_guru" id="nip_guru_edit" placeholder="NIP Guru" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="jk_guru" class="">Jenis Kelamin</label> <label class="text-danger">*</label><br>
                                <input type="radio" name="jk_guru" id="jk_guru_edit_1" value="L"> Laki - laki &nbsp; <input type="radio" name="jk_guru" id="jk_guru_edit_2" value="P"> Perempuan
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="username_edit" class="">Username</label> <label class="text-danger">*</label>
                                <input name="username" id="username_edit" placeholder="Username" type="text" class="form-control readonly" disabled>
                                <input type="checkbox" name="change_username" id="change-username" class="mt-2"> Ubah Username
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="password" class="">Password</label> <label class="text-danger">*</label>
                                <input name="password" id="password_edit" placeholder="Password" type="password" class="form-control readonly" disabled>
                                <input type="checkbox" name="change_pass" id="change-pass" class="mt-2"> Ubah Password
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="email_edit" class="">Email</label> <label class="text-danger">*</label>
                                <input name="email" id="email_edit" placeholder="Email" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="no_guru_edit" class="">Nomor Telepon</label> <label class="text-danger">*</label>
                                <input name="no_guru" id="no_guru_edit" placeholder="Nomor Telepon" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="alamat_guru_edit" class="">Alamat</label> <label class="text-danger">*</label>
                                <textarea name="alamat_guru" id="alamat_guru_edit" cols="30" rows="5" class="form-control" placeholder="Alamat Guru"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group"> 
                                <label for="kota_guru_edit" class="">Kota/Kabupaten</label> <label class="text-danger">*</label>
                                <select name="kota_guru" id="kota_guru_edit" class="form-control">
                                    <option value="">Kota/Kabupaten</option>
                                    <option value="Malang">Malang</option>
                                    <option value="Kabupaten Malang">Kabupaten Malang</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="checkbox" name="change_photo" id="change-photo" class="mt-2"> Ubah Foto Guru
                    <div class="form-row" id="change-photo-display" style="display:none;">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="foto_guru_id" class="">Foto</label>
                                <input type="file" name="foto_guru" class="form-control" id="foto_guru_id">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" id="id_guru">
                <input type="hidden" name="user_id" id="user_id">
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
        function detail(id)
        {
            $.ajax({
                url: '{{ url("guru/ajax_get_guru_by_id") }}',
                method: 'GET',
                data: {id: id},
                dataType: 'json',
                beforeSend: function(){
                    $(".loader").show();
                },
                success: function(response){
                    $(".loader").hide();
                    console.log(response);
                    if(response.data.foto_guru != ""){
                        var images =  'uploads/photos/' + response.data.foto_guru;
                    }else{
                        var images =  'images/avatars/default.jpg';
                    }

                    if(response.data.jk_guru == "L"){
                        var jenkel = 'Laki-laki';
                    }else{
                        var jenkel = 'Perempuan';
                    }

                    var html = `
                    <div class="row">
                        <div class="col-md-7 mr-md-auto my-2">
                            <b>Nama:</b> `+ response.data.nama_guru +`
                            <br>
                            <b>NIP:</b> `+ response.data.nip_guru +`
                            <br>
                            <b>Jenis Kelamin:</b> `+ jenkel +`
                            <br>
                            <b>Nomor Telepon:</b> `+ response.data.no_guru +`
                            <br>
                            <b>Email:</b> `+ response.data.user.email +`
                            <br>
                            <b>Username:</b> `+ response.data.user.username +`
                            <br>
                            <b>Alamat:</b> `+ response.data.alamat_guru +`
                            <br>
                            <b>Kota/Kabupaten:</b> `+ response.data.kota_guru +`
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
                url: '{{ url("guru/ajax_get_guru_by_id") }}',
                method: 'GET',
                data: {id: id},
                dataType: 'json',
                beforeSend: function(){
                    $(".loader").show();
                },
                success: function(response){
                    $(".loader").hide();
                    console.log(response);
                    $("#edit-button").click();
                    $("#nama_guru_edit").val(response.data.nama_guru);
                    $("#nip_guru_edit").val(response.data.nip_guru);
                    
                    if(response.data.jk_guru == 'L'){
                        $("#jk_guru_edit_1").prop('checked', true);
                    }else{
                        $("#jk_guru_edit_2").prop('checked', true);
                    }

                    $("#username_edit").val(response.data.username);
                    $("#email_edit").val(response.data.email);
                    $("#no_guru_edit").val(response.data.no_guru);
                    $("#alamat_guru_edit").val(response.data.alamat_guru);
                    $("#kota_guru_edit").val(response.data.kota_guru);
                    $("#id_guru").val(response.data.id);
                    $("#user_id").val(response.data.user_id);
                },
                error: function(){
                    alert('Error Data!');
                }
            });
        }

        function hapus(id)
        {
            Swal.fire({
                title: 'Apakah anda ingin menghapus ?',
                text: "Anda akan yakin akan menghapus data guru ini",
                type: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#f5365c',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    // form-delete
                    $("#id-user").val(id);
                    var data = $("#form-delete").serialize();
                    $.ajax({
                        url: '{{ url("guru") }}',
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
            })
        }

        $("#change-pass").on('change', function(){
            if ($(this).is(':checked')) {
                $("#password_edit").prop( "disabled", false);
                $("#password_edit").removeClass('readonly');
            }else{
                $("#password_edit").prop( "disabled", true);
                $("#password_edit").addClass('readonly');
            }
        });

        $("#change-username").on('change', function(){
            if ($(this).is(':checked')) {
                $("#username_edit").prop( "disabled", false);
                $("#username_edit").removeClass('readonly');
            }else{
                $("#username_edit").prop( "disabled", true);
                $("#username_edit").addClass('readonly');
            }
        });

        $("#change-photo").on('change', function(){
            if ($(this).is(':checked')) {
                $("#change-photo-display").show();
            }else{
                $("#change-photo-display").hide();
            }
        });

        $("#password-nip").on('change', function(){
            if ($(this).is(':checked')) {
                var nip = $("#nip_guru").val();
                $("#password").val(nip);
            }else{
                $("#password").val("");
            }
        });

        $("#tambah-guru").submit(function(e){
            e.preventDefault();
            $.ajax({
                url: '{{ url("guru") }}',
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
                            message(response.message.head, response.message.body, "error", "info");
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

        $("#edit-guru").submit(function(e){
            e.preventDefault();
            $.ajax({
                url: '{{ url("guru") }}',
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
                            message(response.message.head, response.message.body, "error", "info");
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
    </script>
@endsection