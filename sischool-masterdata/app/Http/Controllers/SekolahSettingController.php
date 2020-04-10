<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sekolah;

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
}
