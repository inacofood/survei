<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListLink;
use PhpOffice\PhpSpreadsheet\IOFactory;


class CcisController extends Controller{
  
    public function index(){
        return view('ccis');
    }
    
}