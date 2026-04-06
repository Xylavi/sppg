<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class GiziController extends Controller
{
    /**
     * Display the gizi dashboard.
     */
    public function dashboard(): View
    {
        return view('backend.gizi.dashboard');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('backend.gizi');
    }
}
