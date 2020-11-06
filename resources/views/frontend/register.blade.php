@extends('frontend.layouts.app')
@section('topheader')
<nav class="fix_topscroll logo_on_fixed  topbar navigation" role="navigation">
    <div class="nav-wrapper container">
        <a id="logo-container" href="{{route('home')}}" class=" brand-logo ">{{mb_strtoupper(session()->get('businessname'))}}</a>
      
        <a href="{{route('home')}}" data-target="" class="waves-effect waves-circle navicon back-button htmlmode show-on-large "><i
        class="mdi mdi-arrow-left" data-page=""></i></a>

     
        <a href="#" data-target="" class="waves-effect waves-circle navicon right nav-site-mode show-on-large"><i
                class="mdi mdi-invert-colors mdi-transition1"></i></a>
    </div>
</nav>

@endsection
@section('content')
<div class="container">
    <div class="section">
      <h5 class="pagetitle">Register</h5>
          </div>
  </div>

  <form method="POST" action="{{ route('user.register.submit') }}">
                                    @csrf
             
  <div class="row">

      <div class="input-field col s10 offset-s1">
        <input id="name" type="text" class="validate @error('name') invalid @enderror" name="name" value="{{old('name')}}">
        @error('name')
          <span class="helper-text" data-error="{{ $message }}">{{ $message }}</span>
        @enderror
     
        <label for="name">Name</label>
      </div>

    </div>

    <div class="row">

      <div class="input-field col s10 offset-s1">
        <input id="password" type="password" name="password" class="validate @error('password') invalid @enderror">
        @error('password')
          <span class="helper-text" data-error="{{ $message }}">{{ $message }}</span>
        @enderror
     
        <label for="password">Password</label>
      </div>

    </div>

    <div class="row">

      <div class="input-field col s10 offset-s1">
        <input id="password_confirmation" type="password" name="password_confirmation" class="validate">
        <label for="password_confirmation">Re Enter Password</label>
      </div>

    </div>

    <div class="row">

      <div class="input-field col s10 offset-s1">
        <input id="mobile" type="tel" name="mobile" class="validate @error('mobile') invalid @enderror" value="{{old('mobile')}}">
        @error('mobile')
          <span class="helper-text" data-error="{{ $message }}">{{ $message }}</span>
        @enderror
        <label for="mobile">Mobile No.</label>
      </div>

    </div>

    <div class="spacer"></div>
<div class="row center">
  <button class="waves-effect waves-light btn-large bg-primary" id="register" type="submit"> {{ __('Register') }}</button>
                                 
</from>
  <div class="spacer"></div>

  <div class="links">

    <a href="{{route('user.login')}}" class='waves-effect'>Already Registered.? Login</a>  </div>
  <div class="spacer"></div>
  <!-- <div class="links">
    <a href="#!.html" class='waves-effect'>    Go Back
    </a>  </div> -->

    <div class="spacer"></div>
    <div class="spacer"></div>
    <div class="spacer"></div>
    <div class="spacer"></div>
    <div class="spacer"></div>
  

</div>


@endsection
@section('script')
@endsection
