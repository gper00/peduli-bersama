<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    /**
     * Menampilkan halaman Syarat dan Ketentuan.
     *
     * @return \Illuminate\View\View
     */
    public function terms()
    {
        return view('static.terms');
    }

    /**
     * Menampilkan halaman Kebijakan Privasi.
     *
     * @return \Illuminate\View\View
     */
    public function privacy()
    {
        return view('static.privacy');
    }
}
