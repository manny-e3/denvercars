<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show the contact page.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('contact');
    }

    /**
     * Handle contact form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'message' => 'required|string',
        ]);

        return redirect('/contact')->with('success', 'Thank you, ' . e($request->name) . '! Your inquiry has been received. Our concierge team will contact you within 2 hours.');
    }
}
