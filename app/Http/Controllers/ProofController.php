<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use Illuminate\Http\Request;

class ProofController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('proofs', [
            'withdraws' => Withdraw::query()
                ->where('status', 'completed')
                ->with('user')
                ->latest('id')
                ->paginate(10),
        ]);
    }
}
