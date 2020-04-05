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
                            <div class="widget-numbers text-white"><span>12</span></div>
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
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
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
                                <textarea name="alamat_guru" id="alamat_guru" cols="30" rows="5" class="form-control" placeholder="Alamat Guru"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"> 
                                <label for="kota_guru" class="">Kota/Kabupaten</label> <label class="text-danger">*</label>
                                <select name="kota_guru" id="kota_guru" class="form-control">
                                    <option value="">Kota/Kabupaten</option>
                                    <option value="Malang">Malang</option>
                                    <option value="Kabupaten Malang">Kabupaten Malang</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="kecamatan_guru" class="">Kecamatan</label> <label class="text-danger">*</label>
                                <select name="kecamatan_guru" id="kecamatan_guru" class="form-control">
                                    <option value="">Kecamatan</option>
                                    <option value="Pakis">Pakis</option>
                                    <option value="Blimbing">Blimbing</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="foto_guru" class="">Foto</label> <label class="text-danger">*</label>
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
@endsection

@section('js')
    <script>
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
                    
                    // if(response.result == false)
                    // {
                    //     message(response.message.head, response.message.body, "error", "info");
                    // }

                    // if(response.result == true)
                    // {
                    //     message(response.message.head, response.message.body, "success", "info", 1000);
                    //     setInterval(function(){ 
                    //         window.location.replace(base_url + response.redirect);
                    //     }, 1000);
                    // }
                    console.log(response);
                    var form_error = response.form_error;
                    for(i = 0; i < form_error.length; i++){
                        console.log(form_error[i]);
                        toastr.error(form_error[i], response.message.head);
                    }
                },
                error: function(){
                    alert("Error Data!");
                }
            });
        });
    </script>
@endsection