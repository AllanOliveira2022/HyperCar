<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::user()->Email != 'Admin@gmail.com') {
            return redirect()->route('inicio'); // Redireciona para o inicio se não for admin
        }
        return view('Admin.admin');
    }
}
