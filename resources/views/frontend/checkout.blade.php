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

    <form method="POST" action="{{ route('frontend.checkout.submit') }}">
        @csrf

        <div class="container">
            <div class="section">
                <div class="row">
                    <div class="col s12 pad-0">
                        <h5 class="pagetitle">Select Delivery</h5>
                        <p>
                            <label>
                                <input type="radio" name="deliveryoption" value="1" checked class="with-gap danger"/>
                                <span>Pick up</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="radio" name="deliveryoption" value="2" class="with-gap info"/>
                                <span>Delivery</span>
                            </label>
                        </p>
                    </div>
                </div>
            </div>
        </div>


        @if(session()->get('iscod') != 0  || session()->get('ispayment') != 0)
            <div class="container" style="display: none;" id="sectionpayment">
                <div class="section">
                    <div class="row">
                        <div class="col s12 pad-0">
                            <h5 class="pagetitle">Select Payment</h5>

                            @if(session()->get('iscod') != 0)
                                <p>
                                    <label>
                                        <input type="radio" name="paymentoption" value="1"
                                               class="with-gap danger"/>
                                        <span>COD</span>
                                    </label>
                                </p>
                            @endif
                            @if(session()->get('ispayment') != 0)
                                <p>
                                    <label>
                                        <input type="radio" name="paymentoption" value="2" checked class="with-gap danger"/>
                                        <span>Online</span>
                                    </label>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="container" style="display: none;" id="sectiondelivery">
            <div class="section">
                <div class="row">
                    <div class="col s12 pad-0">
                        <h5 class="pagetitle">Select Delivery Address</h5>
                        @if(isset($addresses))
                            @foreach($addresses as $key => $list)
                                <p>
                                    <label>
                                        <input type="radio" name="address" value="{{$list->id}}"
                                               class="with-gap info"/>
                                        <span>Address {{$key+1}}</span>
                                <p>{{$list->address_line_1}},{{$list->address_landmark}},{{$list->address_pincode}}</p>
                                </label>
                                </p>
                            @endforeach
                        @endif
                        <p>
                            <a href="{{route('frontend.address')}}"
                               class="waves-effect waves-light btn-large bg-primary ">Add
                                New Address</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" id="sectionpickup">
            <div class="section">
                <div class="row">
                    <div class="col s12 pad-0">
                        <h5 class="pagetitle">Pickup Address</h5>
                        <p>
                            <label>
                                <input type="radio" name="address" value="0" checked class="with-gap info"/>
                                <span>{{session()->get('businessname')}}</span>
                        <p>{{session()->get('address')}}</p>
                    </div>
                </div>

            </div>
        </div>

        <div class="row center">
            <div class="spacer"></div>

            <button class="waves-effect waves-light btn-large bg-primary"
                    type="submit"> {{ __('Place Order') }}</button>

    </form>

@endsection

@section('script')
    <script type="text/javascript">
        $('input[type=radio][name=deliveryoption]').change(function () {
            if (this.value == '1') {
                $("#sectionpickup").show();
                $("#sectiondelivery").hide();
                $("#sectionpayment").hide();

            } else if (this.value == '2') {
                $("#sectionpickup").hide();
                $("#sectiondelivery").show();
                $("#sectionpayment").show();
            }
        });
    </script>
@endsection
