@extends('layouts.app')

@section('content')
<!-- BEGIN CONTENT -->
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-settings icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Pengaturan Akun
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
                    <b>Info!</b> Halaman pengaturan akun adalah halaman yang mengatur akun anda sekarang. <br>
                    Anda dapat mengubah segala informasi yang berkaitan dengan akun anda sekarang.
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Pengaturan Akun</h5>

                        <form id="myForm">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            <div class="form-row">
                                <div class="col-md-4 col-12">
                                    <div class="position-relative form-group">
                                        <label for="name" class="">Nama</label> <span class="text-danger">*</span>
                                        <input name="name" id="name" placeholder="Masukkan nama" type="text" class="form-control" value="{{ Auth::User()->name }}">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="position-relative form-group">
                                        <label for="username" class="">Username</label> <span class="text-danger">*</span>
                                        <input name="username" id="username" placeholder="Masukkan Username" type="text" class="form-control" value="{{ Auth::User()->username }}">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="position-relative form-group">
                                        <label for="email" class="">Email</label> <span class="text-danger">*</span>
                                        <input name="email" id="email" placeholder="Masukkan email" type="text" class="form-control" value="{{ Auth::User()->email }}">
                                    </div>
                                </div>
                            </div>
                            <input type="checkbox" name="change_pass" id="change_pass"> Ganti Password?
                            <div class="form-row mt-2" id="change_pass_row" style="display:none;">
                                <div class="col-md-6 col-12">
                                    <div class="position-relative form-group">
                                        <label for="old_password" class="">Password Lama</label> <span class="text-danger">*</span>
                                        <input name="old_password" id="old_password" placeholder="Masukkan Password Lama" type="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="position-relative form-group">
                                        <label for="new_password" class="">Password Baru</label> <span class="text-danger">*</span>
                                        <input name="new_password" id="new_password" placeholder="Masukkan Password Baru" type="password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
@endsection

@section('js')
<script>
    $("#change_pass").on('change', function(){
        if($(this).is(":checked")){
            $("#change_pass_row").slideDown();
        }else{
            $("#change_pass_row").slideUp();
        }
    });

    $("#myForm").submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();

        $.ajax({
            url: '{{ url("pengaturan_akun") }}',
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
</script>
@endsection