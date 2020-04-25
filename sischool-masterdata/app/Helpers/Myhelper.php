<?php
    namespace App\Helpers;

    use Illuminate\Support\Facades\DB;

    class Myhelper
    {
        public static function get_jenjang_sekolah()
        {
            $sekolah = DB::table('conf_sekolah')->first();

            return $sekolah->jenjang_sekolah;
        }
    }
?>