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
      <h5 class="pagetitle">Product View</h5>
          </div>
  </div>

  <div class="container">
    <div class="section">


<div class="row ui-mediabox  prods prods-boxed ">


  <div class="col s12">
        <div class="prod-img-wrap">


        @if($item->image != null)
        <a class="img-wrap" href="{{asset('asset/Item/'.$item->image)}}" data-fancybox="images"
        data-caption="Women Shoes">
        <img class="z-depth-1" style="width: 100%;" src="{{asset('asset/Item/'.$item->image)}}">

        @else
        <a class="img-wrap" href="{{asset('asset/demo.png')}}" data-fancybox="images"
        data-caption="Women Shoes">
        <img class="z-depth-1" style="width: 100%;" src="{{asset('asset/demo.png')}}">

        @endif
      </a>

    </div>
        <div class="prod-info  boxed z-depth-1">
      <a href="#" ><h5 class="title truncate"> {{$item->title}} </h5>
      </a>      <span class="small date">{{$item->caption}}</span>
            <div class="spacer-line"></div>
            <h5 class="bot-0 price">
            @if($item->discount == 'Yes')
              <strike>Rs.{{$item->price}}</strike>
              @else
              Rs.{{$item->price}}
              @endif
          </h5>
                  <div class="spacer-line"></div>

      <div class='prod-options'>
      @if($item->discount == 'Yes')
      <div class='color'>
      <h5 class="bot-0 price">Rs.{{$item->discountprice}}</h5>
        </div>
        @endif

    </div>
          <div class="spacer-line"></div>


            @if(session()->get('isopen') != '0')
                <span class="addtocart btn-small"
                      data-name="{{$item->title}}"
                      data-price="{{$item->discount == 'Yes' ?$item->discountprice:$item->price}}"
                      data-itemid="{{$item->id}}"
                      data-image="{{$item->image}}"
                      data-qty="1"
                >Add to cart</span>

            @else
                <span class="btn-small">Store Close</span>

            @endif


            <div class="spacer-line"></div>

        <p class="bot-0 text">
        {!!$item->description!!}
        </p>

        <div class="spacer"></div>



          </div>
  </div>



</div>

    </div>
  </div>
@endsection
@section('script')
@endsection
