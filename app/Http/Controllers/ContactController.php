<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        Mail::send(new ContactMail($request->validate([
            'name' => 'required|max:35',
            'email' => 'required|max:85',
            'message' => 'required',
        ])));

        return back()->with('success', 'Thanks For Contacting Us.');
    }
}
