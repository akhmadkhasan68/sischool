<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;
use Validator;
use App\Kelas;
use App\Siswa;
use App\User;
use Image;
use File;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('auth');
    }

    public function index()
    {
        $data['nav_active'] = 'siswa';
        $data['title'] = 'Data Siswa';
        $data['siswa'] = Siswa::all();
        $data['kelas'] = Kelas::all();

        return view('siswa.data_siswa', $data);
    }

    public function ajax_get_siswa()
    {
        $data = Siswa::with('kelas')->get();

        return Datatables::of($data)->make(true);
    }

    public function ajax_get_siswa_by_id(Request $request)
    {
        $data = Siswa::with('kelas', 'user')->where('id', $request->id)->first();

        $json_data = [
            'result' => true,
            'data' => $data
        ];

        return json_encode($json_data);
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

    public function ajax_action_add(Request $request)
    {
        $attrs = [
            'nama_siswa' => 'Nama Siswa',
            'nis_siswa' => 'NIS Siswa',
            'nisn_siswa' => 'NISN Siswa',
            'agama_siswa' => 'Agama',
            'jk_siswa' => 'Jenis Kelamin',
            'kelas_id' => 'Kelas Siswa',
            'no_siswa' => 'Nomor Telepon',
            'alamat_siswa' => 'Alamat Siswa',
            'kota_siswa' => 'Kota Siswa',
            'foto_siswa' => 'Foto Siswa',
            'tempat_lahir_siswa' => 'tempat_lahir_siswa',
            'tgl_lahir_siswa' => 'tgl_lahir_siswa'
        ];

        $validator = Validator::make($request->all(), [
            'nama_siswa' => 'required|max:255',
            'nis_siswa' => [
                'required',
                Rule::unique('table_siswa'),
                'min:5',
                'without_spaces',
                'numeric'
            ],
            'nisn_siswa' => [
                'required',
                Rule::unique('table_siswa'),
                'min:5',
                'without_spaces',
                'numeric'
            ],
            'agama_siswa' => 'required',
            'jk_siswa' => 'required',
            'kelas_id' => 'required',
            'no_siswa' =>  [
                'required',
                Rule::unique('table_siswa'),
                'min:9',
                'numeric',
                'without_spaces'
            ],
            'alamat_siswa' => 'required',
            'kota_siswa' => 'required',
            'foto_siswa' => 'mimes:jpeg,bmp,png|max:2000|image',
            'tempat_lahir_siswa' => 'required',
            'tgl_lahir_siswa' => 'required',
            'username' => [
                Rule::unique('users')
            ],
            'password' => 'max:255|min:5',
            'email' => [
                'required',
                Rule::unique('users')
            ]
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

        //PROCESS UPLOAD IMAGE
        $imageName = '';
        if ($request->hasFile('foto_siswa')) {
            $file = $request->file('foto_siswa');
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
            'name' => $request->nama_siswa,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'SISWA'
        ]);

        $siswa = Siswa::create([
            'nis_siswa' => $request->nis_siswa,
            'nisn_siswa' => $request->nisn_siswa,
            'nama_siswa' => $request->nama_siswa,
            'kelas_id' => $request->kelas_id,
            'agama_siswa' => $request->agama_siswa,
            'jk_siswa' => $request->jk_siswa,
            'no_siswa' => $request->no_siswa,
            'alamat_siswa' => $request->alamat_siswa,
            'kota_siswa' => $request->kota_siswa,
            'tempat_lahir_siswa' => $request->tempat_lahir_siswa,
            'tgl_lahir_siswa' => $request->tgl_lahir_siswa,
            'foto_siswa' => $imageName,
            'user_id' => $users->id
        ]);

        if(!$users || !$siswa)
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
            'message' => ['head' => 'Berhasil', 'body' => 'Berhasil menambahkan data siswa!'],
            'redirect' => '/siswa'
        ];

        return json_encode($json_data);
    }

    public function ajax_action_edit(Request $request)
    {
        $attrs = [
            'nama_siswa' => 'Nama Siswa',
            'nis_siswa' => 'NIS Siswa',
            'nisn_siswa' => 'NISN Siswa',
            'agama_siswa' => 'Agama',
            'jk_siswa' => 'Jenis Kelamin',
            'kelas_id' => 'Kelas Siswa',
            'no_siswa' => 'Nomor Telepon',
            'alamat_siswa' => 'Alamat Siswa',
            'kota_siswa' => 'Kota Siswa',
            'foto_siswa' => 'Foto Siswa',
            'tempat_lahir_siswa' => 'tempat_lahir_siswa',
            'tgl_lahir_siswa' => 'tgl_lahir_siswa'
        ];

        $validator = Validator::make($request->all(), [
            'nama_siswa' => 'required|max:255',
            'nis_siswa' => [
                'required',
                Rule::unique('table_siswa')->ignore($request->id),
                'min:5',
                'without_spaces',
                'numeric'
            ],
            'nisn_siswa' => [
                'required',
                Rule::unique('table_siswa')->ignore($request->id),
                'min:5',
                'without_spaces',
                'numeric'
            ],
            'agama_siswa' => 'required',
            'jk_siswa' => 'required',
            'kelas_id' => 'required',
            'no_siswa' =>  [
                'required',
                Rule::unique('table_siswa')->ignore($request->id),
                'min:9',
                'numeric',
                'without_spaces'
            ],
            'alamat_siswa' => 'required',
            'kota_siswa' => 'required',
            'foto_siswa' => 'mimes:jpeg,bmp,png|max:2000|image',
            'tempat_lahir_siswa' => 'required',
            'tgl_lahir_siswa' => 'required',
            'username' => [
                Rule::unique('users')->ignore($request->user_id)
            ],
            'password' => 'max:255|min:5',
            'email' => [
                'required',
                Rule::unique('users')->ignore($request->user_id)
            ]
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

        if($request->foto_siswa != NULL){
            //PROCESS UPLOAD IMAGE
            $imageName = '';
            if ($request->hasFile('foto_siswa')) {
                $file = $request->file('foto_siswa');
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
        }

        //UPDATE SISWA
        $siswa = Siswa::find($request->id);
        $siswa->nis_siswa = $request->nis_siswa;
        $siswa->nisn_siswa = $request->nisn_siswa;
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->kelas_id = $request->kelas_id;
        $siswa->agama_siswa = $request->agama_siswa;
        $siswa->jk_siswa = $request->jk_siswa;
        $siswa->no_siswa = $request->no_siswa;
        $siswa->alamat_siswa = $request->alamat_siswa;
        $siswa->kota_siswa = $request->kota_siswa;
        $siswa->tempat_lahir_siswa = $request->tempat_lahir_siswa;
        $siswa->tgl_lahir_siswa = $request->tgl_lahir_siswa;
        if($request->foto_siswa != NULL){
            $siswa->foto_siswa = $imageName;
        }
        $siswa->save();

        //CHANGE USER
        $users = User::find($request->user_id);
        $users->name = $request->nama_siswa;
        if($request->change_username != NULL || $request->change_username != ""){
            $users->username = $request->username;
        }
        $users->email = $request->email;
        if($request->change_pass != NULL || $request->change_pass != ""){
            $users->password = Hash::make($request->password);
        }
        $users->save();

        if(!$siswa || !$users)
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
            'message' => ['head' => 'Berhasil', 'body' => 'Berhasil merubah data siswa!'],
            'redirect' => '/siswa'
        ];

        return json_encode($json_data);
    }

    public function ajax_action_delete(Request $request)
    {
        $delete_siswa = Siswa::where('user_id', $request->id)->delete();
        $delete_user = User::destroy($request->id);

        if(!$delete_siswa || !$delete_user)
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
            'message' => ['head' => 'Berhasil', 'body' => 'Berhasil menghapus data siswa!'],
            'redirect' => '/siswa'
        ];

        return json_encode($json_data);
    }
}
