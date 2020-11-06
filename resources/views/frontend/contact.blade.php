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
            <h5 class="pagetitle">Contact Us</h5>
        </div>
    </div>


    <div class="container">
        <div class="section">

            <div class="card contactus">
                <div class="row ">
                    <div class="col s12 pad-0"><h5 class="bot-20 sec-tit  ">Address</h5>
                        <div>{{session()->get('address')}}</div>
                    </div>
                </div>
            </div>


            <div class="card contactus">
                <div class="row ">
                    <div class="col s12 pad-0"><h5 class="bot-20 sec-tit  ">Contact</h5>
                        <div>Mobile: +91 {{session()->get('mobile')}}<br/>
                            Email: {{session()->get('email')}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card contactus">
                <div class="row ">
                    <div class="col s12 pad-0"><h5 class="bot-20 sec-tit  ">Timing</h5>
                        <div>
                            {{session()->get('time')}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('script')
@endsection
