<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PbbMapController extends Controller
{
    /**
     * Show the pbb listing in LeafletJS map.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('pbbs.map');
    }
}
