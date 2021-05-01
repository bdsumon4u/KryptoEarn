<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GatewayController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $addresses = $request->validate($this->rules());
        $extra = array_merge($request->user()->extra ?? [], [
            'gateway' => compact('addresses') +[
                'updated_at' => now()->toDateTimeString(),
            ],
        ]);
        $request->user()->update(compact('extra'));

        return back()->with('success', 'Updated Gateway Addresses.');
    }

    private function rules()
    {
        return [
            'perfect_money' => 'nullable',
            'bitcoin' => 'nullable',
            'payeer' => 'nullable',
        ];
    }
}
