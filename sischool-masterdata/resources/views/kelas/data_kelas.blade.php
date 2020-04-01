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
            <div class="row mt-3">
                <div class="col-md-12 col-lg-12 col-12">
                    <div class="alert alert-info">
                        <b>Info!</b> Halaman data kelas adalah halaman yang menampilkan kelas yang terdaftar pada sistem. <br> 
                        Anda dapat menambahkan, mengubah (edit), atau menghapus kelas yang ada. <br> 
                        Data yang terdaftar pada sistem akan terhubung dengan data yang lain.
                    </div>
                </div>
            </div>
        </div>  

        
    </div>
</div>
<!-- END CONTENT -->
@endsection
