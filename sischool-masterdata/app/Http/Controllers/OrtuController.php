<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('siswa.data_ortu', $data);
    }
}
