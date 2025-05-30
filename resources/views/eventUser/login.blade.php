@php
$event = App\Event::findOrFail($id);

$email = "";
if(Auth::user()){
    $email = Auth::user()->email;
}
@endphp

@extends('layouts.auth')

@section('title')
{{ $event->name }}
@endsection

@section('title-text')
Hello there!
@endsection

@section('subtitle-text')
{{ $login["text"] }}
@endsection

@section('scripts_before')
{{-- @if(isset($id) && api('RECAPTCHA_SECRET_KEY',$id) && api('RECAPTCHA_SITE_KEY',$id))
<script src="https://www.google.com/recaptcha/api.js?render={{ api('RECAPTCHA_SITE_KEY',$id)}}"></script>
@endif --}}
@endsection

@section('form')

@section('styles')
<style>
    #form .login-btn{
        border: none;
    }
    #form .login-btn:hover{
        background-color: {{ $event->secondary_color }};
        /* padding: 5px 7px; */
    }
    #form .fieldInput:focus {
        color: #495057;
        background-color: #fff;
        border-color: {{ $event->primary_color }};
        outline: 0;
    }
        
    .btn:focus, .btn.focus {
        box-shadow: none !important;
    }
</style>

@endsection

<form id="form" action="{{ route('event.user.confirmLogin', ['subdomain' => $subdomain]) }}" method="post">
    @csrf
    <div class="">
        <label for="{{ $login["field"] }}">{{ $login["label"] }}</label>
        
        <input value="{{ old($login["field"]) ?? $email }}" class="fieldInput form-control mb-3 @error($login["field"]) is-invalid @enderror"
            type="{{ $login["field"] == 'email' ? 'email' : 'text' }}" id="" name="{{ $login["field"] }}"
            placeholder="{{ $login["placeholder"] }}" />
        @error($login["field"])
        <span class="invalid-feedback" role="alert">{{ ($message)  }}</span>
        @enderror
        @if ($notFound)
        <span class="invalid-feedback" role="alert">Please check your login details</span>
        @endif
        @if ($captchaError)
        <span class="invalid-feedback" role="alert">Unable to verify captcha</span>
        @endif
    </div>

    <div class="input-group">
        <input type="hidden" id="token" name="token">
    </div>

    <div class="input-group input-footer">
        
        <button class="login-btn theme-btn btn primary-filled" onclick="onSubmit" style="background-color: {{ $event->primary_color }}">Login</button>
    </div>
    <p class="text mt-3">By logging in and using the platform, you hereby accept our  <a href="{{ route('privacyPolicy',['subdomain'=>$subdomain]) }}" ><b>Privacy Policy</b></a> {{--  <a data-toggle="modal" data-target="#privacyPolicy" >Privacy Policy</a>--}}. For more details <a href="{{ route("faq",['subdomain'=>$subdomain]) }}"><b>read the FAQs</b></a></p>
     <div class="disclaimer" style="line-height: 1.2rem;">
        {!! $event->login_disc !!}
        {{-- <p> <strong> Disclaimer: </strong>  By entering the Baltimore Alumnae Chapter's Centennial Matinee, you affirm that you are a ticketed guest and will not share your viewing access to the program with those without a paid ticket. Anyone who violates this trust may be subject to suspension of program access without refund and disciplinary action per Delta Sigma Theta's Code of Conduct policies.</p>
        <p></p> --}}
     </div>

    <div class="clearfix"></div>
    <div class="clearfix"></div>
</form>
@endsection

@section('scripts_after')
<script>
    // (function onSubmit() {
    //     grecaptcha.ready(function () {
    //         grecaptcha.execute('{{ env("RECAPTCHA_SITE_KEY") }}', {
    //             action: 'homepage'
    //         }).then(function (token) {
    //             document.querySelector("#token").value = token
    //         });
    //     });
    // })()
</script>
@endsection