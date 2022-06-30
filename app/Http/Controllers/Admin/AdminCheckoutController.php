<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Checkout\Paid;
use App\Models\Checkout;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminCheckoutController extends Controller
{
    public function update(Request $request, Checkout $checkout)
    {
        DB::beginTransaction();

        try {
            $checkout->update([
                'is_paid' => true
            ]);

            // Send Email to User
            Mail::to($checkout->user->email)->send(new Paid($checkout));

            DB::commit();

            return redirect()->route('admin.dashboard')->with('success', "Checkout with ID {$checkout->id} has been updated!");
        } catch (Exception) {
            DB::rollBack();

            return redirect()->route('admin.dashboard')->with('error', "Checkout with ID {$checkout->id} error updated!");
        }
    }
}
