<?php

namespace App\Http\Controllers\User;

use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $checkouts = Checkout::with('camp')->whereUserId(Auth::id())->get();

        return view('user.dashboard', [
            'checkouts' => $checkouts,
        ]);
    }
}
