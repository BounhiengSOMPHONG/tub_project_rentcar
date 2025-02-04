<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerCtrl extends Controller
{
    public function index(){
        return view('manager.index');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
