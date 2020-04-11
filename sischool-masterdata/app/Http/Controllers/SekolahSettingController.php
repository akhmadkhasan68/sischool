<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sekolah;
use Validator;
use Image;
use File;

class SekolahSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['nav_active'] = 'pengaturan_sekolah';
        $data['sekolah'] = Sekolah::first();

        return view('pengaturan_sekolah.sekolah', $data);
    }

    private function upload_image($file)
    {
        $imageName = time().'.'.$file->getClientOriginalExtension();  
        $save = $file->move(public_path('/uploads/logo/'), $imageName);
        if(!$save)
        {
           return false;
        }else{
            return true;
        }
    }

    public function ajax_action_update_sekolah(Request $request)
    {
        $attrs = [
            'nama_sekolah' => 'Nama sekolah',
            'npsn_sekolah' => 'NPSN sekolah',
            'jenjang_sekolah' => 'Jenjang sekolah',
            'tipe_sekolah' => 'Tipe sekolah',
            'telepon_sekolah' => 'Nomor Telepon sekolah',
            'email_sekolah' => 'Email sekolah',
            'fax_sekolah' => 'Fax sekolah',
            'alamat_sekolah' => 'Alamat sekolah',
            'kota_sekolah' => 'Kota sekolah'
        ];

        $column = [
            'nama_sekolah' => 'required|max:100',
            'npsn_sekolah' => 'required|numeric',
            'jenjang_sekolah' => 'required',
            'tipe_sekolah' => 'required',
            'telepon_sekolah' => 'required|min:9|numeric',
            'email_sekolah' => 'email|required',
            'fax_sekolah' => 'numeric',
            'alamat_sekolah' => 'min:10|required',
            'kota_sekolah' => 'required'
        ];
        if($request->change_logo == 'on')
        {
            $logo = ['logo_sekolah' => 'mimes:jpeg,bmp,png|max:2000|image|required'];
            $column = array_merge($column, $logo);
        }

        $validator = Validator::make($request->all(), $column);
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

        if($request->change_logo == 'on'){
            $file = $request->file('logo_sekolah');
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
        }

        //UPDATE GURU
        $sekolah = Sekolah::find($request->id);
        $sekolah->nama_sekolah = $request->nama_sekolah;
        $sekolah->npsn_sekolah = $request->npsn_sekolah;
        $sekolah->jenjang_sekolah = $request->jenjang_sekolah;
        $sekolah->tipe_sekolah = $request->tipe_sekolah;
        $sekolah->telepon_sekolah = $request->telepon_sekolah;
        $sekolah->email_sekolah = $request->email_sekolah;
        $sekolah->fax_sekolah = $request->fax_sekolah;
        $sekolah->web_sekolah = $request->web_sekolah;
        $sekolah->alamat_sekolah = $request->alamat_sekolah;
        $sekolah->kota_sekolah = $request->kota_sekolah;
        if($request->change_logo == "on"){
            $sekolah->logo_sekolah = $imageName;
        }
        $sekolah->save();

        if(!$sekolah)
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
            'message' => ['head' => 'Berhasil', 'body' => 'Berhasil merubah data informasi sekolah!'],
            'redirect' => '/pengaturan_sekolah'
        ];

        return json_encode($json_data);
    }

    public function ajax_action_update_ppdb(Request $request)
    {
        //UPDATE PPDB
        $sekolah = Sekolah::find($request->id);
        $sekolah->status_ppdb = $request->status_ppdb;
        $sekolah->save();

        $json_data = [
            'result' => true,
            'form_error' => '',
            'message' => ['head' => 'Berhasil', 'body' => 'Berhasil merubah status PPDB sekolah!'],
            'redirect' => '/pengaturan_sekolah'
        ];

        return json_encode($json_data);
    }
}
