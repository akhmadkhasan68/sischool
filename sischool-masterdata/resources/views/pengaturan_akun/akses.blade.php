@extends('layouts.app')

@section('content')
<!-- BEGIN CONTENT -->
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-settings icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Pengaturan Hak Akses User
                        <div class="page-title-subheading">
                            Pengaturan hak akses user pada sistem {{ config('app.name') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>  


        <div class="row">
            <div class="col-md-12 col-lg-12 col-12">
                <div class="alert alert-info">
                    <b>Info!</b> Halaman pengaturan hak akses adalah halaman yang menampilkan data user dengan level admin yang terdaftar pada sistem. <br> 
                    Anda dapat mengubah hak akses user yang terdaftar pada sistem yang ada. <br> 
                    Halaman ini hanya untuk hak akses super user saja.
                </div>
            </div>
        </div>  

        <div class="row">
            <div class="col-md-12 col-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Data User</h5>

                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="my-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Username</th>
                                                <th>Email</th>
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
@endsection

@section('modal')
<button class="btn btn-primary btn-block" data-toggle="modal" data-target=".pengaturan-user" id="pengaturan-button" style="display:none;"><i class="fa fa-plus"></i> Pengaturan</button>

<div class="modal fade pengaturan-user" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pengaturan Hak Akses User <span id="user-name"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="body-pengaturan">
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $("#my-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{url("pengaturan_akses/ajax_get_user")}}',
        aoColumns: [
            {
                "data": "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "name" },
            { "data": "username" },
            { "data": "email" },
            { "data": function (data, type, dataToSet) {
                var html = `
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="pengaturan(`+ data.id +`)"><i class="fa fa-cog"></i> Pengaturan</button>
                    </td>
                `;
                return html;
                }
            }
        ]
    });

    function pengaturan(id)
    {
        $.ajax({
            url: '{{ url("pengaturan_akses/ajax_get_user_by_id") }}',
            method: 'GET',
            data: {id: id},
            dataType: 'json',
            beforeSend: function()
            {
                $(".loader").show();
            },
            success: function(response)
            {
                $(".loader").hide();
                console.log(response);

                $("#pengaturan-button").click();

                $("#user-name").html(response.data.name);

                if(response.data.si_masterdata == 1)
                {
                    var checked_masterdata = 'checked';
                    var label_masterdata = `<div class="badge badge-success">Memiliki hak akses</div>`;
                }else{
                    var label_masterdata = `<div class="badge badge-danger">Belum hak akses</div>`;
                }

                var html = `
                    <div class="alert alert-info">
                        <strong>Perhatian</strong> Centang item untuk memberikan hak akses. <br>
                        Hapus tanda centang untuk menghapus hak akses.
                    </div>
                    <form id="akses-form">
                        @csrf
                        @method('patch')
                        <input type="hidden" id="id" name="id" value="`+ response.data.id +`">
                        <table class="table table-bordered">
                            <tr>
                                <td><input type='checkbox' class='checked' name="si_masterdata" value="1" `+ checked_masterdata +`></td>
                                <td><strong>SI-Masterdata</strong></td>
                                <td>`+ label_masterdata +`</td>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="col-md-3">
                                <button type="button" onclick="submit_form()" class="btn btn-primary btn-block">Simpan</button>
                            </div>
                        </div>
                    </form>
                `;

                $("#body-pengaturan").html(html);
            },
            error: function()
            {
                alert('Error Data!');
            }
        });
    }

    function submit_form(){
        var data = $("#akses-form").serialize();
        $.ajax({
            url: '{{ url("pengaturan_akses/ajax_action_ubah_akses") }}',
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
            error: function()
            {
                alert('Error Data!');
            }
        });
    }
</script>
@endsection