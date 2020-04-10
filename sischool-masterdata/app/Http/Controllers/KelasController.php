<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use App\Guru;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['nav_active'] = 'kelas';  
        $data['kelas'] = Kelas::all();
        $data['guru'] = Guru::all();

        return view('kelas.data_kelas', $data);
    }

    public function ajax_action_add_kelas(Request $request)
    {
        //Mass Asignment Insert Method
        $kelas = Kelas::create([
                'kode_kelas' => $request->kode_kelas,
                'nama_kelas' => $request->nama_kelas,
                'tingkat_kelas' => $request->tingkat_kelas,
                'jurusan_kelas' => $request->jurusan_kelas,
                'wali_kelas' => $request->wali_kelas
            ]);

        if(!$kelas)
        {
            $json_data = [
                'result' => false,
                'form_error' => '',
                'message' => ['head' => 'Gagal', 'body' => 'Ada kesalahan saat memasukkan data. Lakukan beberapa saat lagi!'],
                'redirect' => ''
            ];
            return json_encode($json_data);
            die();
        }

        $json_data = [
            'result' => true,
            'form_error' => '',
            'message' => ['head' => 'Berhasil', 'body' => 'Berhasil menambahkan data kelas!'],
            'redirect' => '/kelas'
        ];

        return json_encode($json_data);
    }

    public function ajax_action_edit_kelas(Request $request)
    {
        $kelas = Kelas::find($request->id_kelas);
        $kelas->kode_kelas = $request->kode_kelas;
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->tingkat_kelas = $request->tingkat_kelas;
        $kelas->jurusan_kelas = $request->jurusan_kelas;
        $kelas->wali_kelas = $request->wali_kelas;
        $kelas->save();

        if(!$kelas)
        {
            $json_data = [
                'result' => false,
                'form_error' => '',
                'message' => ['head' => 'Gagal', 'body' => 'Ada kesalahan saat mengubah data. Lakukan beberapa saat lagi!'],
                'redirect' => ''
            ];
            return json_encode($json_data);
            die();
        }

        $json_data = [
            'result' => true,
            'form_error' => '',
            'message' => ['head' => 'Berhasil', 'body' => 'Berhasil mengubah data kelas!'],
            'redirect' => '/kelas'
        ];

        return json_encode($json_data);
    }

    public function ajax_action_delete_kelas(Request $request)
    {
        $delete = Kelas::destroy($request->id_kelas);

        if(!$delete)
        {   
            $json_data = [
                'result' => false,
                'form_error' => '',
                'message' => ['head' => 'Gagal', 'body' => 'Ada kesalahan saat menghapus data. Lakukan beberapa saat lagi!'],
                'redirect' => ''
            ];
            return json_encode($json_data);
            die();
        }

        $json_data = [
            'result' => true,
            'form_error' => '',
            'message' => ['head' => 'Berhasil', 'body' => 'Berhasil menghapus data kelas!'],
            'redirect' => '/kelas'
        ];

        return json_encode($json_data);
    }

    public function ajax_get_kelas_by_id(Request $request)
    {
        $row = Kelas::find($request->id);
        $json_data = [
            'result' => true,
            'data' => $row
        ];
        return json_encode($json_data);
    }
}
