<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class SwitchLanguage extends Controller
{
    public function index($lang)
    {
        Cookie::queue(Cookie::make('lang', $lang, 2629800));
        return back();
    }
}
