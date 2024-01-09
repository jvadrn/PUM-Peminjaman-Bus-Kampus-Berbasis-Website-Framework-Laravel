<?php

namespace App\Http\Controllers\landingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class landingPageController extends Controller
{
    public function __invoke(){
        return view('landingPage/landingPage');
    }
}
