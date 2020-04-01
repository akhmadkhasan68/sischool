<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JurusanController extends Controller
{
    public function index()
    {
        $data['nav_active'] = 'jurusan';
        $data['jurusan'] = DB::table('table_jurusan')->get();
        
        return view('jurusan.data_jurusan', $data);
    }

    public function add_jurusan()
    {
        $data['nav_active'] = 'jurusan';
        return view('jurusan.add_jurusan', $data);
    }

    public function proses_insert(Request $request)
    {
        $jurusan = DB::table('table_jurusan')->insert(
            array(
                'kode_jurusan' => $request->kode_jurusan, 
                'nama_jurusan' => $request->nama_jurusan
            )
        );

        return redirect('/jurusan');
    }
}
