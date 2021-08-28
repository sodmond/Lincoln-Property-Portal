@extends('layouts.email-temp')

@section('content')
<div style="text-align: left;">
    <p>Hello {{ $profile['firstname'] }},</p>
    <p>You have successfully registered on our portal. See your profile details and referral link below:</p>
    <div>
        <p><strong>Full Name:</strong><br>{{ $profile['firstname'].' '.$profile['lastname'] }}</p>
        <p><strong>Gender:</strong><br>{{ $profile['gender'] }}</p>
        <p><strong>Date of Birth:</strong><br>{{ $profile['dob'] }}</p>
        <p><strong>Phone:</strong><br>{{ $profile['phone'] }}</p>
        <p><strong>State:</strong><br>{{ $profile['state'] }}</p>
        <p><strong>Country:</strong><br>{{ $profile['country'] }}</p>
        <p><strong>Account Name:</strong><br>{{ $profile['acct_name'] }}</p>
        <p><strong>Bank Name:</strong><br>{{ $profile['bank_name'] }}</p>
        <p><strong>Account Number:</strong><br>{{ $profile['acct_name'] }}</p>
        <h4>Your Referral Link</h4>
        <a href="{{ $ref_url }}">{{ $ref_url }}</a>
    </div>
</div>
@endsection