@extends('layouts.app')

@section('content')
 <!-- BEGIN CONTENT -->
 <div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-link icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Data Jurusan
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
                    <b>Info!</b> Halaman data jurusan adalah halaman yang menampilkan jurusan yang terdaftar pada sistem. <br> 
                    Anda dapat menambahkan, mengubah (edit), atau menghapus jurusan yang ada. <br> 
                    Data yang terdaftar pada sistem akan terhubung dengan data yang lain.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card mb-3 widget-content bg-midnight-bloom">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Jurusan</div>
                            <div class="widget-subheading">Jurusan yang terdaftar</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>12</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <a href="/jurusan/tambah" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
        </div>
        
        @if(session()->has('message'))
            <div class="row mt-3">
                <div class="col-md-12 col-12">
                    <div class="alert alert-success">
                        <b>Selamat!</b> {{ session()->get('message') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">Data Jurusan</h5>
                        <table class="mb-0 table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Jurusan</th>
                                <th>Nama Jurusan</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                ?>
                                @foreach($jurusan as $row )
                                    <tr>
                                        <th scope="row"><?php echo $no++;?></th>
                                        <td>{{ $row->kode_jurusan }}</td>
                                        <td>{{ $row->nama_jurusan }}</td>
                                        <td>
                                            <a href="{{ url('kelas/edit/$row->id') }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Ubah</a>
                                            <button class="btn btn-sm btn-danger" onclick="deleteKelas('{{ $row->id }}')"><i class="fa fa-trash"></i> Hapus</button>
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
<!-- END CONTENT -->
@endsection