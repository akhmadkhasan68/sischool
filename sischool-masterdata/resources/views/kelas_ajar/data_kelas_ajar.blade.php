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
                    <div>Data Kelas Ajar Guru
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
                    <b>Info!</b> Halaman data kelas ajar guru adalah halaman yang menampilkan kelas ajar guru yang terdaftar pada sistem. <br> 
                    Pada halaman ini anda dapat mengatur kelas yang diajar oleh guru yang ada.<br>
                    Data yang terdaftar pada sistem akan terhubung dengan data yang lain.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card mb-3 widget-content bg-grow-early">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Data Kelas Ajar</div>
                            <div class="widget-subheading">Kelas Ajar Guru yang terdaftar</div>
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
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target=".tambah-mapel"><i class="fa fa-plus"></i> Tambah Kelas Ajar</button>
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
                                                <th>Nama Guru</th>
                                                <th>NIP</th>
                                                <th>Kode Mapel</th>
                                                <th>Nama Mapel</th>
                                                <th>Kode Kelas</th>
                                                <th>Nama Kelas</th>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Kelas Ajar</h5>
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
                                <label for="guru_id" class="">Pilih Guru <span class="text-danger">*</span></label> 
                                <select name="guru_id" id="guru_id" class="form-control">
                                    <option value="">Pilih Guru</option>
                                    @foreach($guru as $rg)
                                    <option value="{{$rg->id}}">{{$rg->nama_guru}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="mapel_guru_id" class="">Pilih Mapel <span class="text-danger">*</span></label> 
                                <select name="mapel_guru_id" id="mapel_guru_id" class="form-control">
                                    <option value="">Pilih Mapel</option>
                                    @foreach($mapel as $rm)
                                    <option value="{{$rm->id}}">{{$rm->mapel->nama_mapel}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="mapel_id" id="mapel_id">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Pilih Kelas <span class="text-danger">*</span></label> 
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Kelas</th>
                                            <th>Nama Kelas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kelas as $rk)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="kelas_id[]" value="{{$rk->id}}">
                                            </td>
                                            <td>
                                                {{$rk->kode_kelas}}
                                            </td>
                                            <td>
                                                {{$rk->nama_kelas}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
            ajax: '{{url("kelas_ajar_guru/ajax_get_kelas_ajar")}}',
            aoColumns: [
                {
                    "data": "id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { "data": "mapel_guru.guru.nama_guru" },
                { "data": "mapel_guru.guru.nip_guru" },
                { "data": "mapel_guru.mapel.kode_mapel" },
                { "data": "mapel_guru.mapel.nama_mapel" },
                { "data": "kelas.kode_kelas" },
                { "data": "kelas.nama_kelas" },
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

        $("#guru_id").on('change', function(){
            var id = $(this).val();

            $.ajax({
                url: '{{url("kelas_ajar_guru/ajax_search_mapel_guru_by_guru")}}',
                method: 'GET',
                data: {
                    id: id
                },
                dataType: 'json',
                beforeSend: function()
                {
                    $('.loader').show();
                },
                success: function(response)
                {
                    $(".loader").hide();
                    
                    var html = '<option value="">Pilih Mapel</option>';
                    for(i = 0; i < response.data.length; i++)
                    {
                        html += `
                            <option value='`+ response.data[i].id +`'>`+ response.data[i].mapel.nama_mapel +`</option>
                        `;
                    }

                    $("#mapel_guru_id").html(html);
                    $("#mapel_id").val("");
                },
                error: function()
                {
                    alert('Error Data!');
                }
            });
        });

        $("#mapel_guru_id").on('change', function(){
            var mapel_guru_id = $(this).val();

            $.ajax({
                url: '{{url("kelas_ajar_guru/ajax_search_mapel_guru_by_id_mapel")}}',
                method: 'GET',
                data: {
                    mapel_guru_id: mapel_guru_id
                },
                dataType: 'json',
                beforeSend: function()
                {
                    $('.loader').show();
                },
                success: function(response)
                {
                    $(".loader").hide();
                    
                    $("#mapel_id").val(response.data.mapel_id);
                },
                error: function()
                {
                    alert('Error Data!');
                }
            });
        });

        $("#tambah-mapel").submit(function(e){
            e.preventDefault();
            var data = $(this).serialize();

            $.ajax({
                url: '{{ url("kelas_ajar_guru") }}',
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

        function deleteMapel(id)
        {  
            Swal.fire({
                title: 'Apakah anda ingin menghapus ?',
                text: "Anda akan yakin akan menghapus data kelas ajar ini",
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
                        url: '{{ url("kelas_ajar_guru") }}',
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

