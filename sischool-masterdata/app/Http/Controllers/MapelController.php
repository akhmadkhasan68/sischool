<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DataTables;
use Validator;
use MyHelper;
use App\Mapel;

class MapelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['title'] = 'Mata Pelajaran';
        $data['nav_active'] = 'mapel';
        $data['mapel'] = Mapel::all();

        return view('mapel.data_mapel', $data);
    }

    public function ajax_get_mapel()
    {
        $data = Mapel::all();

        return Datatables::of($data)->make(true);
    }

    public function ajax_get_mapel_by_id(Request $request)
    {
        $row = Mapel::find($request->id);

        $json_data = [
            'result' => true,
            'data' => $row
        ];

        return json_encode($json_data);
    }

    public function ajax_action_add_mapel(Request $request)
    {
        //SET ATTRIBUTE
        $attrs = [
            'kode_mapel' => 'Kode Mapel',
            'nama_mapel' => 'Nama Mapel'
        ];

        $validator = Validator::make($request->all(), [
            'kode_mapel' => [
                'required',
                'without_spaces',
                Rule::unique('table_mapel')
            ],
            'nama_mapel' => [
                'required',
                Rule::unique('table_mapel')
            ]
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

         //Mass Asignment Insert Method
         $mapel = Mapel::create([
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,
            'kelompok_mapel' => $request->kelompok_mapel
        ]);

        if(!$mapel)
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
            'redirect' => '/mapel'
        ];

        return json_encode($json_data);
    }

    public function ajax_action_edit(Request $request)
    {
        //SET ATTRIBUTE
        $attrs = [
            'nama_mapel' => 'Nama Mapel'
        ];

        $validator = Validator::make($request->all(), [
            'nama_mapel' => [
                'required',
                Rule::unique('table_mapel')->ignore($request->id)
            ]
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

        $mapel = Mapel::find($request->id);
        $mapel->kode_mapel = $request->kode_mapel;
        $mapel->nama_mapel = $request->nama_mapel;
        $mapel->kelompok_mapel = $request->kelompok_mapel;
        $mapel->save();

        $json_data = [
            'result' => true,
            'form_error' => '',
            'message' => ['head' => 'Berhasil', 'body' => 'Berhasil mengubah data mapel!'],
            'redirect' => '/mapel'
        ];

        return json_encode($json_data);
    }

    public function ajax_action_delete(Request $request)
    {
        $delete = Mapel::destroy($request->id);

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
            'redirect' => '/mapel'
        ];

        return json_encode($json_data);
    }
}
