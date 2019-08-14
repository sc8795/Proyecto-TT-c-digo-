<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Header_footerController extends Controller
{
    public function acerca_de(){
        return view("acerca_de");
    }
}
