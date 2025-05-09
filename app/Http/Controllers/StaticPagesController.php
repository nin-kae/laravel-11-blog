<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function home(): View
    {
        return view('static_pages/home');
    }

    public function help(): View
    {
        return view('static_pages/help');
    }

    public function about(): View
    {
        return view('static_pages/about');
    }
}
