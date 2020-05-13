<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;
use Validator;
use App\Siswa;
use App\User;
use App\Ortu;
use Image;
use File;

class OrtuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['nav_active'] = 'ortu';
        $data['title'] = 'Data Orang Tua';
        $data['ortu'] = Ortu::all();
        
        return view('siswa.data_ortu', $data);
    }

    public function ajax_get_ortu()
    {
        $data = Ortu::with('siswa')->get();

        return Datatables::of($data)->make(true);
    }

    public function ajax_action_add(Request $request)
    {
        $attrs = [
            'nama_ortu' => 'Nama',
            'siswa_nis' => 'NIS Siswa',
            'pendidikan_ortu' => 'Pendidikan',
            'pekerjaan_ortu' => 'Pekerjaan',
            'status_hubungan' => 'Status Hubungan',
            'gaji_ortu' => 'Gaji',
            'jk_ortu' => 'Jenis Kelamin',
            'username' => 'Username',
            'password' => 'Password',
            'no_ortu' => 'Nomor Telepon',
            'email' => 'Email',
            'alamat_ortu' => 'Alamat',
            'kota_ortu' => 'Kota/Kabupaten'
        ];

        $status_hubungan = $request->status_hubungan;

        $validator = Validator::make($request->all(), [
            'nama_ortu' => 'required',
            'siswa_nis' => [
                'required',
                'exists:App\Siswa,nis_siswa'
            ],
            'pendidikan_ortu' => 'required',
            'pekerjaan_ortu' => 'required',
            'gaji_ortu' => 'required',
            'status_hubungan' => [
                'required',
                Rule::unique('table_siswa_ortu')->where(function ($query) {
                    return $query->where('status_hubungan');
                })
            ],
            'jk_ortu' => 'required',
            'username' => [
                Rule::unique('users')
            ],
            'password' => 'max:255|min:5',
            'no_ortu' => 'required',
            'email' => [
                'required',
                Rule::unique('users')
            ],
            'alamat_ortu' => 'required',
            'kota_ortu' => 'required'
        ]);

        $validator->setAttributeNames($attrs);

        if($validator->fails())
        {
            $errors = $validator->errors();
            $json_data = [
                'result' => false,
                'form_error' => $errors->all(),
                'message' => ['head' => 'Gagal', 'body' => 'Mohon maaf, ada beberapa form yang harus diisi!'],
                'redirect' => ''
            ];

            return json_encode($json_data); 
            die();
        }

        //INSERT USER
        $user = User::create([
            'username' => $request->username,
            'name' => $request->nama_ortu,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'ORTU'
        ]);

        $ortu = Ortu::create([
            'siswa_nis' => $request->siswa_nis,
            'nama_ortu' => $request->nama_ortu,
            'jk_ortu' => $request->jk_ortu,
            'no_ortu' => $request->no_ortu,
            'alamat_ortu' => $request->alamat_ortu,
            'kota_ortu' => $request->kota_ortu,
            'pendidikan_ortu' => $request->pendidikan_ortu,
            'pekerjaan_ortu' => $request->pekerjaan_ortu,
            'gaji_ortu' => $request->gaji_ortu,
            'status_hubungan' => $request->status_hubungan,
            'id_user' => $user->id
        ]);

        if(!$user && !$ortu)
        {
            $json_data = [
                'result' => false,
                'form_error' => '',
                'message' => ['head' => 'Gagal', 'body' => 'Ada kesalahan saat memasukkan data. Lakukan beberapa saat lagi!']
            ];

            return json_encode($json_data);
            die();
        }

        $json_data = [
            'result' => true,
            'form_error' => '',
            'message' => ['head' => 'Berhasil', 'body' => 'Berhasil menambahkan data ortu!'],
            'redirect' => '/ortu'
        ];

        return json_encode($json_data);
    }
}
