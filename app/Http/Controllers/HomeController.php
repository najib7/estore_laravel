<?php

namespace App\Http\Controllers;

use App\Traits\Statistics;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use Statistics;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stats = [
            'products' => $this->products(),
            'purchases' => $this->purchases(),
            'sales' => $this->sales(),
        ];

        return view('app.home', compact('stats'));
    }
}
