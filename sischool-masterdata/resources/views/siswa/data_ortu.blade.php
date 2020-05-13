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
                    <div>Data Orang Tua / Wali
                        <div class="page-title-subheading">
                            Data orang tua / wali terdaftar pada sistem {{ config('app.name') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>  


        <div class="row">
            <div class="col-md-12 col-lg-12 col-12">
                <div class="alert alert-info">
                    <b>Info!</b> Halaman data orang tua/wali adalah halaman yang menampilkan orang tua/wali yang terdaftar pada sistem. <br> 
                    Anda dapat menambahkan, mengubah (edit), atau menghapus orang tua/wali yang ada. <br> 
                    Data yang terdaftar pada sistem akan terhubung dengan data yang lain.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card mb-3 widget-content bg-grow-early">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Orang Tua/Wali</div>
                            <div class="widget-subheading">Orang Tua/Wali yang terdaftar</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{count($ortu)}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target=".tambah-ortu"><i class="fa fa-plus"></i> Tambah Ortu</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Data Orang Tua / Wali</h5>

                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="my-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>NIS Anak</th>
                                                <th>Nama Anak</th>
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
    <input type="hidden" name="id" id="id-ortu">
</form>
@endsection

@section('modal')
<div class="modal fade tambah-ortu" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Orang Tua/Wali</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="tambah-ortu">
                @csrf()
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="nama_ortu" class="">Nama <span class="text-danger">*</span></label> 
                                <input name="nama_ortu" id="nama_ortu" placeholder="Nama Orang tua / Wali" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="siswa_nis" class="">NIS Siswa (Anak)<span class="text-danger">*</span></label>
                                <input name="siswa_nis" id="siswa_nis" placeholder="Masukkan NIS anak" type="number" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="pendidikan_ortu" class="">Pendidikan Terakhir <span class="text-danger">*</span></label> 
                                <select name="pendidikan_ortu" id="pendidikan_ortu" class="form-control">
                                    <option value="">Pilih Pendidikan Terakhir</option>
                                    <option value="SD/MI">SD/MI</option>
                                    <option value="SMP/MTs">SMP/MTs</option>
                                    <option value="SMA/SMK">SMA/SMK</option>
                                    <option value="D1">D1</option>
                                    <option value="D3">D3</option>
                                    <option value="D4">D4</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="pekerjaan_ortu" class="">Pekerjaan <span class="text-danger">*</span></label> 
                                <select name="pekerjaan_ortu" id="pekerjaan_ortu" class="form-control">
                                    <option value="">Pilih Pekerjaan</option>
                                    <option value="Buruh">Buruh</option>
                                    <option value="Tani">Tani</option>
                                    <option value="Wiraswasta">Wiraswasta</option>
                                    <option value="PNS">PNS</option>
                                    <option value="Polri/TNI">Polri/TNI</option>
                                    <option value="Perangkat Desa">Perangkat Desa</option>
                                    <option value="Nelayan">Nelayan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="status_hubungan" class="">Status Hubungan <span class="text-danger">*</span></label> 
                                <select name="status_hubungan" id="status_hubungan" class="form-control">
                                    <option value="">Pilih Status Hubungan Orang Tua</option>
                                    <option value="Ayah">Ayah</option>
                                    <option value="Ibu">Ibu</option>
                                    <option value="Wali">Wali</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="gaji_ortu" class="">Gaji Orang Tua / Bulan<span class="text-danger">*</span></label>
                                <input name="gaji_ortu" id="gaji_ortu" placeholder="Masukkan gaji ortu" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="jk_ortu" class="">Jenis Kelamin <span class="text-danger">*</span></label>
                                <br>
                                <input type="radio" name="jk_ortu" id="jk_ortu1" value="L"> Laki-laki &nbsp;
                                <input type="radio" name="jk_ortu" id="jk_ortu2" value="P"> Perempuan
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="username" class="">Username <span class="text-danger">*</span></label>
                                <input name="username" id="username" placeholder="Username Orang tua / Wali" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="password" class="">Password <span class="text-danger">*</span></label>
                                <input name="password" id="password" placeholder="Password Orang tua / Wali" type="password" class="form-control">
                                <input type="checkbox" id="password-nis" class="mt-2"> Password samakan dengan NIS
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="no_ortu" class="">Nomor Telepon <span class="text-danger">*</span></label>
                                <input name="no_ortu" id="no_ortu" placeholder="Nomor Telepon Orang Tua" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="email" class="">Email <span class="text-danger">*</span></label>
                                <input name="email" id="email" placeholder="Email Orang Tua" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="alamat_ortu" class="">Alamat</label> <label class="text-danger">*</label>
                                <textarea name="alamat_ortu" id="alamat_ortu" cols="30" rows="5" class="form-control" placeholder="Masukkan alamat lengkap orang tua"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group"> 
                                <label for="kota_ortu" class="">Kota/Kabupaten</label> <label class="text-danger">*</label>
                                <input name="kota_ortu" id="kota_ortu" placeholder="Kota/Kabupaten orang tua" type="text" class="form-control">
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
        ajax: '{{url("ortu/ajax_get_ortu")}}',
        aoColumns: [
            {
                "data": "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "nama_ortu" },
            { "data": "siswa_nis" },
            { "data": "siswa.nama_siswa" },
            { "data": function (data, type, dataToSet) {
                var html = `
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="detail()"><i class="fa fa-info"></i> Detail</button>
                        <button class="btn btn-success btn-sm" onclick="edit()"><i class="fa fa-edit"></i> Ubah</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteSiswa()"><i class="fa fa-trash"></i> Hapus</button>
                    </td>
                `;
                return html;
                }
            }
        ]
    });

    $("#password-nis").change(function(){
        if($(this).is(':checked'))
        {
            var val = $("#siswa_nis").val();
            $("#password").val(val);
        }
        else
        {
            $("#password").val("");
        }
    });

    $("#tambah-ortu").submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();

        $.ajax({
            url: '{{ url("ortu") }}',
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
    });

    /* Dengan Rupiah */
    var dengan_rupiah = document.getElementById('gaji_ortu');
    dengan_rupiah.addEventListener('keyup', function(e)
    {
        dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
    });
    
    /* Fungsi */
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
@endsection
