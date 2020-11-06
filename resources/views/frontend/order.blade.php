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
            <h5 class="pagetitle">Your Order</h5>
        </div>
    </div>


    @if(\Illuminate\Support\Facades\Auth::guard('web')->check())

        @if(count($orders) != 0)
            @foreach($orders as $list)
                <div class="container full">
                    <div class="section">

                        <ul class="collection invoice-item">


                            <li class="collection-item">

                                <div class="item-det">
                                    <span class="title"></span>
                                    <span class="title secondary-content">
                                        @if($list->status == 0)
                                             Order Cancled.
                                        @elseif($list->status == 1)
                                            Order Pending.
                                        @else
                                            Order Delivered.
                                        @endif
                                    </span>
                                </div>
                            </li>

                            <li class="collection-item">

                                <div class="item-det">
                                    <span class="title">{{date('D d M-Y', strtotime($list->created_at))}}</span>
                                    <span class="title secondary-content">#{{$list->ordernumber}}</span>
                                </div>
                            </li>
                             @php($orderhistories = \App\Admin\OrderHistory_MD::where('user_id',session()->get('id'))->where('order_id', $list->id)->get())
                             @if($orderhistories)
                                 @foreach($orderhistories as $orderlist)
                                    <li class="collection-item avatar">

                                        <div class="item-det">
                                            <img src="{{asset('asset/demo.png')}}" alt="" class="circle">
                                            <span class="title">{{$orderlist->name}}</span>
                                            <p>Qty:{{$orderlist->qty}}</p>
                                        </div>

                                        <div class="secondary-content">
                                            <h6 class="top-0 ">Rs.{{$orderlist->price * $orderlist->qty}}</h6>
                                        </div>

                                    </li>

                                @endforeach
                            @endif

                            <li class="collection-item non-avatar total">
                                <div class="item-det">
                                    <h6 class="">Total Amount</h6>
                                </div>
                                <div class="secondary-content">
                                    <h5 class="top-0">Rs.{{$list->total}}</h5>
                                </div>
                            </li>
                        </ul>


                        <div class="spacer"></div>

                    </div>
                </div>

            @endforeach
        @else
            <ul class="collection invoice-item">


                <li class="collection-item non-avatar total">
                    <div class="item-det">
                        <h6 class="">Your Have No Order.</h6>
                    </div>
                </li>


            </ul>


            <div class="spacer"></div>
            <div class="center">
                <a href="{{route('home')}}" class="waves-effect waves-light btn-large bg-primary ">Continue
                    Shopping</a>
                &nbsp;
            </div>


        @endif
    @else
        <div class="spacer"></div>
        <div class="center">
            <a href="{{route('home')}}" class="waves-effect waves-light btn-large bg-primary ">Continue
                Shopping</a>

            @if(!\Illuminate\Support\Facades\Auth::guard('web')->check())
                <a href="{{route('user.login')}}" class="waves-effect waves-light btn-large bg-primary ">Login</a>
            @endif &nbsp;
        </div>
    @endif


@endsection
@section('script')
@endsection
