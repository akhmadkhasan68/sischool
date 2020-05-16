<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DataTables;
use Validator;
use MyHelper;
use App\MapelGuru;
use App\Mapel;
use App\Guru;

class MapelGuruController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('auth');
    }

    public function index()
    {
        $data['title'] = 'Mata Pelajaran Guru';
        $data['nav_active'] = 'mapel_guru';
        $data['gurus'] = Guru::all();
        $data['mapels'] = Mapel::all();

        return view('mapel_guru.data_mapel_guru', $data);
    }

    public function ajax_get_mapel()
    {
        $data = MapelGuru::with('guru', 'mapel')->get();

        return Datatables::of($data)->make(true);
    }

    public function ajax_action_add(Request $request)
    {
        $attrs = [
            'guru_id' => 'Guru',
            'mapel_id' => 'Mapel',
            'kkm' => 'KKM'
        ];
        $validator = Validator::make($request->all(), [
            'guru_id' => 'required',
            'mapel_id' => 'required',
            'kkm' => 'required|without_spaces|numeric|between:30,100'
        ]);
        $validator->setAttributeNames($attrs);

        if($validator->fails())
        {
            $errors = $validator->errors();
            $json_data = [
                'result' => false,
                'form_error' => $errors->all(),
                'message' => ['head' => 'Gagal', 'body' => 'Mohon maaf, ada beberapa form harus diisi!'],
                'redirect' => ''
            ];

            return json_encode($json_data);
            die();
        }

        $mapel = $request->mapel_id;

        for($i = 0; $i < count($mapel); $i++)
        {
            $mapel_guru = MapelGuru::create([
                'guru_id' => $request->guru_id,
                'mapel_id' => $mapel[$i],
                'kkm' => $request->kkm
            ]);
        }

        if(!$mapel_guru)
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
            'message' => ['head' => 'Berhasil', 'body' => 'Berhasil menambahkan data mapel!'],
            'redirect' => '/mapel_guru'
        ];

        return json_encode($json_data);
    }

    public function ajax_action_delete(Request $request)
    {
        $delete = MapelGuru::destroy($request->id);

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
            'message' => ['head'=>'Berhasil', 'body' => 'Selamat, anda berhasil menghapus data mapel ini!'],
            'redirect' => '/mapel_guru'
        ];

        return json_encode($json_data);
    }
}
