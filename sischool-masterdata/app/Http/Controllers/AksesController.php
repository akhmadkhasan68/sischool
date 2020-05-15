<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DataTables;
use App\User;

class AksesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['title'] = 'Pengaturan Hak Akses';
        $data['nav_active'] = 'pengaturan_akses';

        return view('pengaturan_akun.akses', $data);
    }

    public function ajax_get_user()
    {
        $user = Auth::user();
        $user_id = $user->id;

        $data = User::where([
            ['id', '!=', $user_id], 
            // ['level', 'ADMIN']
        ])->get();

        return Datatables::of($data)->make(true);
    }

    public function ajax_get_user_by_id(Request $request)
    {
        $data = User::find($request->id);

        $json_data = [
            'result' => true,
            'data' => $data
        ];
        
        return json_encode($json_data);
    }

    public function ajax_action_ubah_akses(Request $request)
    {
        $user = User::find($request->id);
        if($request->si_masterdata != NULL)
        {
            $user->si_masterdata = $request->si_masterdata;
        }
        else
        {
            $user->si_masterdata = 0;
        }
        $user->save();

        $json_data = [
            'result' => true, 
            'form_error' => '',
            'message' => ['head' => 'Berhasil', 'body' => 'Berhasil merubah hak akses user!'],
            'redirect'  => '/pengaturan_akses'
        ];

        return json_encode($json_data);
    }
}
