<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    /**
     * Display the home page.
     *
     * @return View
     */
    public function home(): View
    {
        $feedItems = [];
        if (auth()->check()) {
            $feedItems = auth()->user()->feed()->paginate(30);
        }

        return view('static_pages/home', compact('feedItems'));
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
