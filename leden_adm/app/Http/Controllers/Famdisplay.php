<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Famdisplay extends Controller
{
    public function display()
    {
//         $string =  'This is data test';
        return view('components.helo', ['name' => 'Chester']);
    }
}
