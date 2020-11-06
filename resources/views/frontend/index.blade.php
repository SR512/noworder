@extends('frontend.layouts.app')
@section('topheader')
    <nav class="fix_topscroll logo_on_fixed  topbar navigation" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" href="{{route('user.home')}}"
               class=" brand-logo ">{{mb_strtoupper(session()->get('businessname'))}}</a>    <!-- <ul class="right hide-on-med-and-down">
        <li><a href="#">Navbar Link</a></li>
      </ul> -->

            <!-- <ul id="nav-mobile" class="sidenav">
                <li><a href="#">Navbar Link</a></li>
              </ul> -->

            <!--         <a href="#" data-target="slide-nav" class="waves-effect waves-circle navicon sidenav-trigger show-on-large"><i
                            class="mdi mdi-menu"></i></a>

             -->
            <!-- <a href="#" data-target="slide-settings"
               class="waves-effect waves-circle navicon right sidenav-trigger show-on-large pulse"><i
                    class="mdi mdi-settings-outline"></i></a> -->

            <a href="#" data-target="" class="waves-effect waves-circle navicon right nav-site-mode show-on-large"><i
                    class="mdi mdi-invert-colors mdi-transition1"></i></a>
            <!-- <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a> -->
        </div>
    </nav>

@endsection
@section('content')



    <div class="carousel carousel-fullscreen carousel-slider home_carousel carousel-products-home">

        @if(isset($sliders))
            @foreach($sliders as $list)
                <div class="carousel-item" href="#carousel-slide-0!">
                    <div class="bg"
                         style="background-image: url('{{asset('asset/Slider/'.$list->backgroundphoto)}}');"></div>
                    <div class="item-content center-align white-text">
                        <div class="spacer-large"></div>
                        <h3>{{$list->name}}</h3>
                        <h5 class="light white-text">{{$list->subtitle}}</h5>
                    </div>
                </div>

            @endforeach
        @endif
    </div>

    <!-- Category -->
    <div class="container">
        <div class="section">
            <h5 class="pagetitle">Categories</h5>
        </div>
    </div>
    <div class="container">
        <a class='dropdown-trigger btn' href='#' data-target='dropdown1855322841'>Select Category<i
                class="mdi mdi-chevron-down"></i></a>

        <!-- Dropdown Structure -->
        <ul id='dropdown1855322841' class='dropdown-content'>
            @if(isset($categories))
                <li id="0" onmousedown="changeCategory(this.id,'All')"><a href="#!">All</a></li>
                @foreach($categories as $list)
                    <li id="{{$list->id}}" onmousedown="changeCategory(this.id,'{{$list->name}}')"><a
                            href="#!">{{$list->name}}</a></li>
                @endforeach
            @endif

        </ul>

        <div class="spacer"></div>
    </div>

    <!-- Product Secation -->
    <div class="divproduct">
        <div class="container">
            <div class="section">
                <h5 class="pagetitle">Products</h5>
            </div>
        </div>
        <div class="container">
            <div class="section">

                <div class="row ui-mediabox  prods prods-boxed   medium-left aligned ">

                    @if(isset($items))
                        @foreach($items as $key => $list)
                            <div class="col s12">
                                <div class="prod-img-wrap">

                                    @if($list->image != null)
                                        <a class="img-wrap" href="{{asset('asset/Item/'.$list->image)}}"
                                           data-fancybox="images"
                                           data-caption="{{$list->title}}"
                                           style="background-image: url('{{asset('asset/Item/'.$list->image)}}');">&nbsp;</a>

                                    @else
                                        <a class="img-wrap" href="{{asset('asset/demo.png')}}" data-fancybox="images"
                                           data-caption="{{$list->title}}"
                                           style="background-image: url('{{asset('asset/demo.png')}}');">&nbsp;</a>

                                    @endif
                                </div>
                                <div class="prod-info  boxed z-depth-1">
                                    <a href="ui-app-products-view.html">
                                        <h5 class="title truncate">{{$list->title}}</h5>
                                    </a> <span class="small date">{{$list->caption}}</span>
                                    <div class="spacer-line"></div>
                                    <h5 class="bot-0 price">
                                        @if($list->discount == 'Yes')
                                            <strike>Rs.{{$list->price}}</strike>
                                        @else
                                            Rs.{{$list->price}}
                                        @endif
                                    </h5>
                                    <div class="spacer-line"></div>

                                    <div class='prod-options'>
                                        @if($list->discount == 'Yes')
                                            <div class='color'>
                                                <h5 class="bot-0 price">Rs.{{$list->discountprice}}</h5>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="spacer-line"></div>


                                    @if(session()->get('isopen') != '0')
                                        <span class="addtocart btn-small"
                                              data-name="{{$list->title}}"
                                              data-price="{{$list->discount == 'Yes' ?$list->discountprice:$list->price}}"
                                              data-itemid="{{$list->id}}"
                                              data-image="{{$list->image}}"
                                              data-qty="1"
                                        >Add to cart</span>

                                    @else
                                        <span class="btn-small">Store Close</span>

                                    @endif

                                    @if($list->description != null)
                                        <a href="{{route('itemDetails',$list->id)}}"><span
                                                class="addtowishlist btn-small">View Details</span></a>
                                    @endif

                                    <div class="spacer-line"></div>


                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(".dropdown-trigger").dropdown();
    </script>
@endsection
