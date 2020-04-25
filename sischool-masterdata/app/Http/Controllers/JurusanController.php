<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Jurusan;
use DataTables;

class JurusanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data['nav_active'] = 'jurusan';
        $data['title'] = 'Data Jurusan';
        $data['jurusan'] = Jurusan::all();
        
        return view('jurusan.data_jurusan', $data);
    }

    public function ajax_get_jurusan()
    {
        $data = Jurusan::all();

        return Datatables::of($data)->make(true);
    }

    public function add_jurusan()
    {
        $data['nav_active'] = 'jurusan';
        $data['title'] = 'Data Jurusan';
        return view('jurusan.add_jurusan', $data);
    }

    public function edit_jurusan($id)
    {
        $data['nav_active'] = 'jurusan';
        $data['title'] = 'Data Jurusan';
        $data['row'] = Jurusan::find($id);

        return view('jurusan.edit_jurusan', $data);
    }

    public function ajax_action_add_jurusan(Request $request)
    {
        //SET ATTRIIBUTE NAME
        $attrs = [
            'kode_jurusan' => 'Kode jurusan',
            'nama_jurusan' => 'Nama jurusan'
        ];
        
        //VALIDATION RULE
        $validator = Validator::make($request->all(), [
            'kode_jurusan' => [
                'required',
                Rule::unique('table_jurusan'),
                'without_spaces'
            ],
            'nama_jurusan' => [
                'required',
                Rule::unique('table_jurusan'),
            ]
        ]);
        $validator->setAttributeNames($attrs);

        //IF VALIDATION RULE IS RUN
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

        //PROCESS INSERT
        $jurusan = Jurusan::create([
            'kode_jurusan' => $request->kode_jurusan,
            'nama_jurusan' => $request->nama_jurusan
        ]);

        //RESPONSE
        $json_data = [
            'result' => true,
            'form_error' => '',
            'message' => ['head' => 'Berhasil', 'body' => 'Selamat, anda berhasil menambahkan data jurusan!'],
            'redirect' => '/jurusan'
        ];

        return json_encode($json_data);
    }

    public function ajax_action_edit_jurusan(Request $request)
    {
        //SET ATTRIIBUTE NAME
        $attrs = [
            'kode_jurusan' => 'Kode jurusan',
            'nama_jurusan' => 'Nama jurusan'
        ];

        //VALIDATION RULE
        $validator = Validator::make($request->all(), [
            'kode_jurusan' => [
                'required',
                Rule::unique('table_jurusan')->ignore($request->id),
                'without_spaces'
            ],
            'nama_jurusan' => [
                'required',
                Rule::unique('table_jurusan')->ignore($request->id),
            ]
        ]);
        $validator->setAttributeNames($attrs);

        //IF VALIDATION RULE IS RUN
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

        //UPDATE JURUSAN
        $jurusan = Jurusan::find($request->id);
        $jurusan->kode_jurusan = $request->kode_jurusan;
        $jurusan->nama_jurusan = $request->nama_jurusan;
        $jurusan->save();

        //RESPONSE
        $json_data = [
            'result' => true,
            'form_error' => '',
            'message' => ['head' => 'Berhasil', 'body' => 'Selamat, anda berhasil merubah data jurusan!'],
            'redirect' => '/jurusan'
        ];

        return json_encode($json_data);
    }

    public function ajax_action_delete_jurusan(Request $request)
    {
        $delete_jurusan = Jurusan::destroy($request->id);

        if(!$delete_jurusan)
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
            'message' => ['head' => 'Berhasil', 'body' => 'Berhasil menghapus data jurusan!'],
            'redirect' => '/jurusan'
        ];

        return json_encode($json_data);
    }
}
