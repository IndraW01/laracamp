<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\Camp;
use App\Models\User;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\Checkout\AfterCheckout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\User\Checkout\Store;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Camp $camp)
    {
        if($camp->isRegistered) {
            return redirect()->route('user.dashboard')->with('error', "You already registered on {$camp->title} camp");
        }

        return view('checkout.create', [
            'camp' => $camp
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request, Camp $camp)
    {
        // mapping request data (Menagmbil semua data yang dibutuhkan)
        $data = $request->all();
        $data['user_id'] = auth()->id();
        $data['camp_id'] = $camp->id;

        DB::beginTransaction();

        try {
            // 1. update table user
            $user = User::whereId(auth()->id())->first();
            $user->userUpdateCheckout($request->only(['email', 'name', 'occupation']));

            // 2. Create table checkout
            $checkout = Checkout::create($data);

            // 3. Send email checkout
            Mail::to(Auth::user()->email)->send(new AfterCheckout($checkout));

            DB::commit();

            return redirect()->route('checkout.success');
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->route('user.dashboard')->with('error', 'Your checkout failed');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        //
    }

    public function success()
    {
        return view('checkout.success');
    }
}
