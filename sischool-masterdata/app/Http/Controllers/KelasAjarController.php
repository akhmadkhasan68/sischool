<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\KelasAjar;
use App\MapelGuru;
use App\Kelas;
use App\Guru;
use App\Mapel;
use DataTables;
use Validator;
use MyHelper;

class KelasAjarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['title'] = 'Kelas Ajar Guru';
        $data['nav_active'] = 'kelas_ajar_guru';
        $data['kelas'] = Kelas::all();
        $data['guru'] = Guru::all();
        $data['mapel'] = MapelGuru::with('guru', 'mapel')->get();

        return view('kelas_ajar.data_kelas_ajar', $data);
    }

    public function ajax_get_kelas_ajar()
    {
        $data = KelasAjar::with('mapel_guru', 'mapel_guru.guru', 'mapel_guru.mapel', 'kelas')->get();

        return Datatables::of($data)->make(true);
    }

    public function ajax_search_mapel_guru_by_guru(Request $request)
    {
        $data = MapelGuru::with('mapel')->where('guru_id', $request->id)->get();

        $json_data = [
            'result' => true,
            'data' => $data
        ];

        return json_encode($json_data);
    }

    public function ajax_search_mapel_guru_by_id_mapel(Request $request)
    {
        $data = MapelGuru::with('mapel')->where('id', $request->mapel_guru_id)->first();

        $json_data = [
            'result' => true,
            'data' => $data
        ];

        return json_encode($json_data);
    }

    public function ajax_action_add(Request $request)
    {
        $attrs = [
            'guru_id' => 'Guru',
            'mapel_guru_id' => 'Mapel',
            'kelas_id' => 'Kelas'
        ];

        $validator = Validator::make($request->all(), [
            'guru_id' => 'required',
            'mapel_guru_id' => 'required',
            'kelas_id' => 'required'
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

        $value = $request->mapel_id;
        $kelas_id = $request->kelas_id;

        for($i = 0; $i < count($kelas_id); $i++)
        {
            //CEK KELAS AJAR GURU
            $cek_mapel_guru = KelasAjar::with('mapel_guru', 'kelas')
                                ->whereHas('mapel_guru', function($q) use($value) {
                                    // Query the name field in status table
                                    $q->where('mapel_id', '=', $value); // '=' is optional
                                })
                                ->where('kelas_id', $kelas_id[$i])
                                ->get();

            if(count($cek_mapel_guru) > 0)
            {
                $mapel = Mapel::find($request->mapel_id);

                $json_data = [
                    'result' => false,
                    'form_error' => '',
                    'message' => ['head' => 'Gagal', 'body' => 'Mohon maaf, mapel '.$mapel->nama_mapel.' pada kelas '.$cek_mapel_guru[0]->kelas->nama_kelas.' sudah ada yang mengajar!'],
                    'redirect' => ''
                ];

                return json_encode($json_data);
                break;
            }
        }

        for($i = 0; $i < count($kelas_id); $i++)
        {
            $insert = KelasAjar::create([
                'mapel_guru_id' => $request->mapel_guru_id,
                'kelas_id' => $kelas_id[$i]
            ]);
        }

        $json_data = [
            'result' => true,
            'form_error' => '',
            'message' => ['head' => 'Berhasil', 'body' => 'Selamat, berhasil menambahkan data Kelas Ajar!'],
            'redirect' => '/kelas_ajar_guru'
        ];

        return json_encode($json_data);
    }
    
    public function ajax_action_delete(Request $request)
    {
        $delete = KelasAjar::destroy($request->id);

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
            'message' => ['head'=>'Berhasil', 'body' => 'Selamat, anda berhasil menghapus data kelas ajar ini!'],
            'redirect' => '/kelas_ajar_guru'
        ];

        return json_encode($json_data);
    }
}  
