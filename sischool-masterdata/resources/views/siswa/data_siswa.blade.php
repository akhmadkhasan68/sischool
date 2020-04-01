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
                    <div>Data Siswa
                        <div class="page-title-subheading">
                            Data siswa terdaftar pada sistem {{ config('app.name') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>  

    </div>
</div>
<!-- END CONTENT -->
@endsection
