<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactInquiryAdminNotification;
use App\Mail\ContactInquiryCustomerConfirmation;

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
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'message' => 'required|string',
        ]);

        // 1. Send Admin Notification Email
        try {
            $adminEmails = \App\Models\User::role('admin')->pluck('email')->unique();
            if ($adminEmails->isEmpty()) {
                $adminEmails = collect(['admin@denverlimocars.com']);
            }
            foreach ($adminEmails as $adminEmail) {
                Mail::to($adminEmail)->send(new ContactInquiryAdminNotification($validated));
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Contact Form Admin Email Failed: ' . $e->getMessage());
        }

        // 2. Send Customer/User Confirmation Email
        try {
            Mail::to($validated['email'])->send(new ContactInquiryCustomerConfirmation($validated));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Contact Form Customer Email Failed: ' . $e->getMessage());
        }

        return redirect('/contact')->with('success', 'Thank you, ' . e($request->name) . '! Your inquiry has been received. Our concierge team will contact you within 2 hours.');
    }
}

