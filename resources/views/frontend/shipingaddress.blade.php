@extends('frontend.layouts.app')
@section('topheader')
    <nav class="fix_topscroll logo_on_fixed  topbar navigation" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" href="{{route('home')}}"
               class=" brand-logo ">{{mb_strtoupper(session()->get('businessname'))}}</a>

            <a href="{{route('home')}}" data-target=""
               class="waves-effect waves-circle navicon back-button htmlmode show-on-large "><i
                    class="mdi mdi-arrow-left" data-page=""></i></a>


            <a href="#" data-target="" class="waves-effect waves-circle navicon right nav-site-mode show-on-large"><i
                    class="mdi mdi-invert-colors mdi-transition1"></i></a>
        </div>
    </nav>

@endsection
@section('content')

    <div class="container">
        <div class="section">
            <h5 class="pagetitle">Shipping Address</h5>
        </div>
    </div>

    <div class="container">

        <div class="section">
            <form method="POST" action="{{ route('frontend.address.submit') }}">
                @csrf

                <div class="row">
                    <div class="input-field col s12">
                        <i class="mdi mdi-circle-edit-outline prefix"></i>
                        <textarea id="textarea-prefix" class="materialize-textarea @error('address') invalid @enderror" style='min-height:50px;' name="address">{{old('')}}</textarea>
                        @error('address')
                        <span class="helper-text" data-error="{{ $message }}">{{ $message }}</span>
                        @enderror
                        <label for="textarea-prefix">Address</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <i class="mdi mdi-circle-edit-outline prefix"></i>
                        <textarea id="textarea-prefix" class="materialize-textarea @error('landmark') invalid @enderror" style='min-height:50px;' name="landmark">{{old('landmark')}}</textarea>
                        @error('landmark')
                        <span class="helper-text" data-error="{{ $message }}">{{ $message }}</span>
                        @enderror
                        <label for="textarea-prefix">Landmark / Area</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <i class="mdi mdi-map-marker-outline prefix"></i>
                        <input id="mobno" type="text" class="validate @error('pincode') invalid @enderror" value="" name="pincode">
                        @error('pincode')
                        <span class="helper-text" data-error="{{ $message }}">{{ $message }}</span>
                        @enderror
                        <label for="mobno">Zip</label>
                    </div>
                </div>

                <div class="spacer"></div>
                <div class="spacer"></div>

                <div class="row">
                    <div class="">
                        <button class="waves-effect waves-light btn-large bg-primary" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

@endsection
@section('script')
@endsection
