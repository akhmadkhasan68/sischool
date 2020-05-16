<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class AccountSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('auth');
    }

    public function index()
    {
        $data['nav_active'] = 'pengaturan_akun';
        $data['title'] = 'Pengaturan Akun';

        return view('pengaturan_akun.akun', $data);
    }

    public function ajax_action_edit_account(Request $request)
    {
        $attrs = [
            'name' => 'Nama',
            'username' => 'Username',
            'email' => 'Email',
            'username' => 'Username',
            'old_password' => 'Password lama',
            'new_password' => 'Password baru'
        ];

        $validator_config =  [
            'name' => 'required',
            'username' => [
                'required',
                Rule::unique('users')->ignore($request->id)
            ],
            'email' => [
                'required',
                Rule::unique('users')->ignore($request->id)
            ]
        ];
        if($request->change_pass != NULL)
        {
            $pass = [
                'old_password' => 'required|min:6',
                'new_password' => 'required|min:6'
            ];

            $validator_config = array_merge($validator_config, $pass);
        }

        $validator = Validator::make($request->all(), $validator_config);
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

        if($request->old_password != NULL && $request->change_pass != NULL)
        {
            $cek_old_pass = Hash::check($request->old_password, Auth::user()->password);
            if($cek_old_pass == FALSE)
            {
                $json_data = [
                    'result' => FALSE,
                    'form_error' => '',
                    'message' => ['head' => 'Gagal', 'body' => 'Mohon maaf, Password lama tidak cocok!'],
                    'redirect' => ''
                ];
                return json_encode($json_data);
                die();
            }

            $cek_new_pass = Hash::check($request->old_password, Auth::user()->password);
            if($cek_new_pass == TRUE)
            {
                $json_data = [
                    'result' => FALSE,
                    'form_error' => '',
                    'message' => ['head' => 'Gagal', 'body' => 'Mohon maaf, Password baru tidak boleh sama dengan password lama!'],
                    'redirect' => ''
                ];
                return json_encode($json_data);
                die();
            }

            $user = User::find($request->id);
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->new_password);
            $user->save();

            if(!$user)
            {
                $json_data = [
                    'result' => FALSE,
                    'form_error' => '',
                    'message' => ['head' => 'Gagal', 'body' => 'Mohon maaf, ada kesalahan saat mengubah data!'],
                    'redirect' => ''
                ];
                return json_encode($json_data);
                die();
            }

            $json_data = [
                'result' => true,
                'form_error' => '',
                'message' => ['head' => 'Berhasil', 'body' => 'Selamat, berhasil merubah data akun'],
                'redirect' => '/pengaturan_akun'
            ];
        }
        else
        {
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();

            if(!$user)
            {
                $json_data = [
                    'result' => FALSE,
                    'form_error' => '',
                    'message' => ['head' => 'Gagal', 'body' => 'Mohon maaf, ada kesalahan saat mengubah data!'],
                    'redirect' => ''
                ];
                return json_encode($json_data);
                die();
            }

            $json_data = [
                'result' => true,
                'form_error' => '',
                'message' => ['head' => 'Berhasil', 'body' => 'Selamat, berhasil merubah data akun'],
                'redirect' => '/pengaturan_akun'
            ];
        }

        return json_encode($json_data);
    }
}
