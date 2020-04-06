<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Guru;
use App\User;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Image;
use File;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['nav_active'] = 'guru';
        $data['result'] = Guru::all();

        return view('guru.data_guru', $data);
    }

    private function upload_image($file)
    {
        $imageName = time().'.'.$file->getClientOriginalExtension();  
        $save = $file->move(public_path('/uploads/photos/'), $imageName);
        if(!$save)
        {
           return false;
        }else{
            return true;
        }
    }

    public function ajax_action_add_guru(Request $request)
    {
        //SET ATTRIBUTES NAME VALIDATION
        $attrs = [
            'nama_guru' => 'Nama',
            'nip_guru' => 'NIP',
            'jk_guru' => 'Jenis kelamin',
            'no_guru' => 'Nomor Telepon',
            'foto_guru' => 'Foto'
        ];

        //GIVE A RULE FOR FORMS
        $validator = Validator::make($request->all(), [
            'nama_guru' => 'required|max:255',
            'nip_guru' => [
                'required',
                Rule::unique('table_guru'),
                'max:255',
                'min:5'
            ],
            'jk_guru' => 'required',
            'username' => [
                'required',
                Rule::unique('users')
            ],
            'password' => 'required|max:255|min:5',
            'email' => [
                'required',
                Rule::unique('users')
            ],
            'no_guru' => [
                'required',
                Rule::unique('table_guru'),
                'min:9',
                'max:13'
            ],
            'alamat_guru' => 'required',
            'kota_guru' => 'required',
            'kecamatan_guru' => 'required',
            'foto_guru' => 'mimes:jpeg,bmp,png|max:2000|image',
        ]);
        $validator->setAttributeNames($attrs); 
        
        //PROCESS VALIDATION
        if ($validator->fails()) 
        {
            $errors = $validator->errors();
            $json_data = [
                'result' => FALSE,
                'form_error' => $errors->all(),
                'message' => ['head' => 'Gagal', 'body' => 'Mohon maaf, ada beberapa form yang harus diisi!'],
                'redirect' => ''
            ];
            return json_encode($json_data);
            die();
        }

        //PROCESS UPLOAD IMAGE
        $imageName = '';
        if ($request->hasFile('foto_guru')) {
            $file = $request->file('foto_guru');
            $upload_image = $this->upload_image($file);
            if($upload_image == false)
            {
                $json_data = [
                    'result' => false,
                    'form_error' => '',
                    'message' => ['head' => 'Gagal', 'body' => 'Mohon maaf, ada kesalahan saat mengupload gambar!'],
                    'redirect' => ''
                ];
                return json_encode($json_data);
                die();
            }
            $imageName = time().'.'.$file->getClientOriginalExtension();  
        }else{
            $imageName = '';  
        }
        
        //MASS ASSIGMENT INSERT USERS METHOD
        $users = User::create([
            'username' => $request->username,
            'name' => $request->nama_guru,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'GURU'
        ]);

        //MASS ASIGNMENT INSERT GURU METHOD
        $guru = Guru::create([
            'nama_guru' => $request->nama_guru,
            'nip_guru' => $request->nip_guru,
            'jk_guru' => $request->jk_guru,
            'no_guru' => $request->no_guru,
            'alamat_guru' => $request->alamat_guru,
            'kecamatan_guru' => $request->kecamatan_guru,
            'kota_guru' => $request->kota_guru,
            'foto_guru' => $imageName,
            'id_user' => $users->id
        ]);

        if(!$guru || !$users)
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
            'message' => ['head' => 'Berhasil', 'body' => 'Berhasil menambahkan data guru!'],
            'redirect' => '/guru'
        ];

        return json_encode($json_data);
    }
}
