<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Guru;
use Illuminate\Validation\Rule;

class GuruController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['nav_active'] = 'guru';

        return view('guru.data_guru', $data);
    }

    public function ajax_action_add_guru(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_guru' => 'required|max:255',
            'nip_guru' => [
                'required',
                Rule::unique('table_guru'),
                'max:255',
                'min:5'
            ],
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
            'foto_guru' => 'required|mimes:jpeg,bmp,png|max:2000',
        ]);

        if ($validator->fails()) {
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
        

    }
}
