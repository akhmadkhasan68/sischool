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
                    <div>Data Jurusan
                        <div class="page-title-subheading">
                            <?=date("l, d F Y") ?>
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