<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class TestsController extends Controller
{
    public function index(): Factory|Application|View
    {
        return view('tests.index');
    }
}
