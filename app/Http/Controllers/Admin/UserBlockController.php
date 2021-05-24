<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserBlockController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $user)
    {
        if (($extra = $user->extra) && data_get($extra, 'is_blocked', false)) {
            $user->update(['extra' => ['is_blocked' => false]]);
            return back()->with('success', 'User Is Blocked.');
        }

        $user->update(['extra' => ['is_blocked' => true]]);
        return back()->with('success', 'User Is Unblocked.');
    }
}
