<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['nav_active'] = 'siswa';
        $data['title'] = 'Data Siswa';
        return view('siswa.data_siswa', $data);
    }
}
