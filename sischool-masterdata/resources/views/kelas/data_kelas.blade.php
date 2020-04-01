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
                            <div class="widget-numbers text-white"><span>12</span></div>
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

        <div class="row mb-3">
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
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12 col-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Data Kelas</h5>

                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="table-responsive">
                                    <table class="table table-">
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
                                        <tbody>
                                            <?php $no = 1;?>
                                            @foreach($kelas as $row)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $row->kode_kelas }}</td>
                                                    <td>{{ $row->nama_kelas }}</td>
                                                    <td>{{ $row->tingkat_kelas }}</td>
                                                    <td>{{ $row->jurusan_kelas }}</td>
                                                    <td>{{ $row->wali_kelas }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Ubah</button>
                                                        <button class="btn btn-sm btn-danger" onclick="deleteKelas('halo')"><i class="fa fa-trash"></i> Hapus</button>
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
<!-- END CONTENT -->
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
                                    <option value="0">Tingkat Kelas</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="jurusan_kelas" class="">Jurusan</label>
                                <select name="jurusan_kelas" id="jurusan_kelas" class="form-control">
                                    <option value="0">Jurusan</option>
                                    <option value="IPA">IPA</option>
                                    <option value="IPS">IPS</option>
                                    <option value="BAHASA">BAHASA</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="position-relative form-check">
                        <input name="check" id="pilih-walikelas" type="checkbox" class="form-check-input">
                        <label for="pilih-walikelas" class="form-check-label">Pilih wali kelas untuk kelas ini</label>
                    </div>
                    <div class="form-row mt-3">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="wali_kelas" class="">Pilih Wali Kelas</label>
                                <select name="wali_kelas" id="wali_kelas" class="form-control">
                                    <option value="0">Wali Kelas</option>
                                    <option value="Rulita Octania, S.Pd.">Rulita Octania, S.Pd.</option>
                                    <option value="Retnowati Dijah Hasfiani, S.Pd.">Retnowati Dijah Hasfiani, S.Pd.</option>
                                    <option value="Rina Kartika, SS.,M.Pd">Rina Kartika, SS.,M.Pd</option>
                                    <option value="Wahyu Windari, M.Pd.">Wahyu Windari, M.Pd.</option>
                                    <option value="Kartini, M.Pd.">Kartini, M.Pd.</option>
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
@endsection

@section('js')
<script>
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
    
    function deleteKelas(kelas){
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
                alert(kelas);
            }
        })
    }
</script>
@endsection