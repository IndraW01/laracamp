<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function dashboard()
    {
        switch (Auth::user()->is_admin) {
            case true:
                return redirect()->route('admin.dashboard');
                break;
            default:
                return redirect()->route('user.dashboard');
                break;
        }
    }
}
