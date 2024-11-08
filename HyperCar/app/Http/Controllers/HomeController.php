<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('Auth.home');
    }

    public function Inicio(){
        return view('Cliente.inicio');
    }

    public function admin(){
        return view('Admin.admin');
    }
}
