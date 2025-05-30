@extends('layouts.auth')

@php
$event = App\Event::where('slug',$subdomain)->first();

$email = "";
if(Auth::user()){
    $email = Auth::user()->email;
}
@endphp

@section('title')
    Eventee Login
@endsection

@section('title-text')
    Hello there!
@endsection


@section('subtitle-text')
    Sign in your account
@endsection

@section('form')
@if(Session::has('eventee-register'))
    <script>
        var show = "{{ Session::get('eventee-register') }}";
        alert(show);
    </script>
@endif
    

<form action="{{ route('exhibiter.login',$subdomain) }}" method="post">
    @csrf
    <div class="input-group">
        <label for="emailaddress">Email address</label>
        <br>
        <div class="input-group input-group-merge mb-3">
            <input value="{{ $email ?? '' }}" class="field form-control @error('email') is-invalid @enderror" type="email" id="emailaddress" name="email" placeholder="Enter your email" />
            @error('email')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="input-group">
        <label for="password">Password</label>
        <div class="input-group input-group-merge">
            <input type="password" name="password" id="password" class="field form-control @error('password') is-invalid @enderror" placeholder="Enter your password" />
            <div class="input-group-append" data-password="false">
                <div class="input-group-text">
                    <span class="password-eye"></span>
                </div>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <br>

    <button class="log-btn theme-btn btn primary-filled" style="background-color: {{ $event->primary_color }}" type="submit">Login</button>


    
    <div class="clearfix"></div>
</form>
@endsection


@section('extra')
    <a href="{{ route('password.request') }}">Forgot Password? Recover Now</a>
@endsection