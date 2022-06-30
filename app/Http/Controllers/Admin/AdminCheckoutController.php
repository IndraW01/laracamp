<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCheckoutController extends Controller
{
    public function update(Request $request, Checkout $checkout)
    {
        DB::beginTransaction();

        try {
            $checkout->update([
                'is_paid' => true
            ]);

            DB::commit();

            return redirect()->route('admin.dashboard')->with('success', "Checkout with ID {$checkout->id} has been updated!");
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->route('admin.dashboard')->with('error', "Checkout with ID {$checkout->id} error updated!");
        }
    }
}
