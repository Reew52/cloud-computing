<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyController extends Controller
{
    
    public function __construct(){

    }

    Public function index(){
        return view('admins.views.index');
    }

    Public function hay(){
        return 'gay the';
    }
}
