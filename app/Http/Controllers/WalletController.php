<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = $request->user()->load('wallets');
        $transactions = $user->transactions()->with('wallet')->latest()->take(5)->get();
        return view('user.wallets.index', compact('user', 'transactions'));
    }

    public function withdraw()
    {
        return view('user.wallets.withdraw');
    }

    public function deposit()
    {
        return view('user.wallets.deposit');
    }

    public function transfer(Request $request)
    {
        $user = $request->user()->load('wallets');
        return view('user.wallets.transfer', compact('user'));
    }
}
