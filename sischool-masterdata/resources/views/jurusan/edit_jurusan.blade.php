@extends('layouts.app')

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-id icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Edit Data {{ $row->nama_jurusan }}
                        <div class="page-title-subheading">
                            <?=date("l, d F Y") ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        
        <div class="row">
            <div class="col-md-3">
                <a href="{{ url('/jurusan') }}" class="btn btn-danger btn-block"><i class="fa fa-chevron-left"></i> Kembali</a>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">Edit Data</h5>
                        <form id="myform" method="post">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="id" value="{{ $row->id }}">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Kode Jurusan</label>
                                        <input name="kode_jurusan" placeholder="Masukkan kode jurusan" type="text" class="form-control" value="{{ $row->kode_jurusan }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Nama Jurusan</label>
                                        <input name="nama_jurusan" placeholder="Masukkan nama jurusan" type="text" class="form-control" value="{{ $row->nama_jurusan }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary btn-block">Ubah Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $("#myform").submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: '{{ url("jurusan/edit") }}',
            method: 'POST',
            data: data,
            dataType: 'json',
            beforeSend: function(){
                $(".loader").show();
            },
            success: function(response){
                $('.loader').hide();
                
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