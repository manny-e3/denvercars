@extends('emails.limo_layout')

@section('content')
<p style="font-size:15px; margin-bottom:8px; color:#c9a84c; letter-spacing:0.05em;">
    New Contact Inquiry Received
</p>
<p style="font-size:14px; margin-bottom:28px; line-height:1.8; color:#d4d4d4;">
    A new contact inquiry has been submitted from the website form. Please see the details below:
</p>

<p class="section-title">Inquiry Details</p>
<table class="detail-table">
    <tr>
        <td>Name</td>
        <td>{{ $name }}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td><a href="mailto:{{ $email }}" style="color:#c9a84c; text-decoration:none;">{{ $email }}</a></td>
    </tr>
    <tr>
        <td>Phone</td>
        <td>{{ $phone }}</td>
    </tr>
</table>

<p class="section-title">Message</p>
<div class="note-box">
    {{ $messageBody }}
</div>

<div style="text-align:center; margin-top:32px;">
    <a href="mailto:{{ $email }}?subject=Re:%20Denver%20Limo%20Cars%20Inquiry" class="btn">Reply Directly</a>
</div>
@endsection
