@extends('emails.limo_layout')

@section('content')
<p style="font-size:15px; margin-bottom:8px; color:#c9a84c; letter-spacing:0.05em;">
    Dear {{ $name }},
</p>
<p style="font-size:15px; margin-bottom:28px; line-height:1.8;">
    Thank you for contacting <strong style="color:#c9a84c">Denver Limo Cars</strong>. We have received your message and our concierge team is currently reviewing your inquiry.
</p>

<div class="alert-banner">
    <p>Our average response time is under 2 hours. If you have an urgent request, please call us directly at +1-720-671-4118.</p>
</div>

<p class="section-title">Summary of Your Message</p>
<div class="note-box" style="margin-bottom:28px;">
    {{ $messageBody }}
</div>

<p style="font-size:14px; color:#aaa; line-height:1.8; margin-top:20px;">
    One of our private transport specialists will be in touch with you shortly at <strong>{{ $email }}</strong> or <strong>{{ $phone }}</strong> to coordinate details.
</p>

<hr style="border:none; border-top:1px solid #1e1e1e; margin:28px 0;">
<p style="font-size:13px; color:#888; text-align:center; line-height:1.8;">
    Questions or updates?<br>
    Reply to this email or contact us at <a href="mailto:hello@denverlimocars.com" style="color:#c9a84c; text-decoration:none;">hello@denverlimocars.com</a>.
</p>
@endsection
