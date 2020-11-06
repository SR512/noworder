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
            <h5 class="pagetitle">Your Cart</h5>
        </div>
    </div>

    <div class="container full">
        <div class="section">
            <div class="row ui-mediabox  prods prods-boxed   medium-left aligned ">

                @php($grandTotal=0)
                @if(!empty(Session::get('foodcart')))

                    @foreach(array_filter(session()->get('foodcart')) as $key => $list)
                        <div class="col s12">
                            <div class="prod-img-wrap">

                                @if($list['image'] != null)
                                    <a class="img-wrap" href="{{asset('asset/Item/'.$list['image'])}}"
                                       data-fancybox="images"
                                       data-caption="{{$list['name']}}"
                                       style="background-image: url('{{asset('asset/Item/'.$list['image'])}}');">&nbsp;</a>

                                @else
                                    <a class="img-wrap" href="{{asset('asset/demo.png')}}" data-fancybox="images"
                                       data-caption="{{$list['name']}}"
                                       style="background-image: url('{{asset('asset/demo.png')}}');">&nbsp;</a>

                                @endif
                            </div>
                            <div class="prod-info  boxed z-depth-1">
                                <h5 class="title truncate">{{$list['name']}}</h5>
                                <div class="spacer-line"></div>
                                <h5 class="bot-0 price">Rs.<span class="tdPrice{{$key}}">{{$list['price']}}</span></h5>
                                <div class="spacer-line"></div>

                                <div class='prod-options'>
                                    <div class='color'>
                                        <button type="button" class="btn btn-small"
                                                data-type="plus"
                                                data-name="qty{{$key}}"
                                                data-row="tdPrice{{$key}}"
                                                data-itemid="{{$list['itemid']}}"
                                                data-title="{{$list['name']}}"
                                                data-price="{{$list['price']}}"
                                                data-image="{{$list['image']}}"
                                                onclick="qtybtn(this)"
                                        ><i class="mdi mdi-plus"></i></button>
                                        <input type="number" style="width: 30px;text-align: center;"
                                               value="{{$list['qty']}}"
                                               id="qty{{$key}}"
                                               readonly>
                                        <button type="button" class="btn btn-small"
                                                data-type="minus"
                                                data-name="qty{{$key}}"
                                                data-row="tdPrice{{$key}}"
                                                data-itemid="{{$list['itemid']}}"
                                                data-title="{{$list['name']}}"
                                                data-price="{{$list['price']}}"
                                                data-image="{{$list['image']}}"
                                                onclick="qtybtn(this)"><i class="mdi mdi-minus"></i>
                                        </button>

                                    </div>
                                </div>

                                <div class="spacer-line"></div>


                                <span class="btn-small"
                                      onclick="deleteRow(this,{{$list['itemid']}},'tdPrice{{$key}}')"
                                      data-id="{{$list['itemid']}}"
                                >Remove From Cart</span>

                                <div class="spacer-line"></div>


                            </div>
                        </div>
                        @php($grandTotal = $list['price'] * $list['qty'] + $grandTotal)
                    @endforeach

                    <ul class="collection invoice-item">


                        <li class="collection-item non-avatar total">
                            <div class="item-det">
                                <h6 class="">Total Amount</h6>
                            </div>
                            <div class="secondary-content">
                                <h5 class="top-0">Rs.<span class="grandtotal">{{$grandTotal}}</span></h5>
                            </div>
                        </li>


                    </ul>


                    <div class="spacer"></div>
                    <div class="center">
                        <a href="{{route('home')}}" class="waves-effect waves-light btn-large bg-primary ">Continue
                            Shopping</a>

                        @if(!\Illuminate\Support\Facades\Auth::guard('web')->check())
                            <a href="{{route('user.login')}}" class="waves-effect waves-light btn-large bg-primary ">Login</a>
                        @else
                            @if(session()->get('isopen') != 0)
                                <a href="{{route('frontend.checkout')}}"
                                   class="waves-effect waves-light btn-large bg-primary ">Checkout</a>
                                @else
                                <a href="#"
                                   class="waves-effect waves-light btn-large bg-primary ">Store Close</a>

                            @endif
                        @endif &nbsp;
                    </div>

                @else
                    <ul class="collection invoice-item">


                        <li class="collection-item non-avatar total">
                            <div class="item-det">
                                <h6 class="">Your Cart is Empty.</h6>
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

            </div>
        </div>
    </div>


    </div>
    </div>



@endsection
@section('script')

    <script type="text/javascript">

        function qtybtn(identifier) {
            var name = $(identifier).data('title');
            var row = $(identifier).data('row');
            var price = $(identifier).data('price');
            var itemid = $(identifier).data('itemid');
            var _token = "{{csrf_token()}}";
            var type = $(identifier).data('type');
            var image = $(identifier).data('image');
            var textbox = $(identifier).data('name');
            var value = parseInt($("#" + textbox).val());
            var grandtotal = parseInt($(".grandtotal").text());

            if (type == "plus") {
                value++;
                $.ajax({
                    url: '{{route('frontend.updatecart')}}',
                    method: 'POST',
                    data: {
                        name: name, price: price, qty: value, itemid: itemid, _token: _token, image: image
                    }, beforeSend: function () {
                        $('.preloader-background').show();
                    },
                    success: function (response) {
                        M.toast({html: response});
                        $("#" + textbox).val(value);
                        $("." + row).text(price * value);
                        $(".grandtotal").text(grandtotal + price);
                        $('.preloader-background').fadeOut('slow');


                    }, error: function (xhr) {
                        M.toast({html: xhr.statusText, classes: ' red lighten-2 white-text'});
                        $('.preloader-background').fadeOut('slow');
                    }
                });
            } else {
                value--;
                if (value != 0) {
                    $.ajax({
                        url: '{{route('frontend.updatecart')}}',
                        method: 'POST',
                        data: {
                            name: name, price: price, qty: value, itemid: itemid, _token: _token, image: image
                        }, beforeSend: function () {
                            $('.preloader-background').show();
                        },
                        success: function (response) {
                            M.toast({html: response});
                            $("#" + textbox).val(value);
                            $("." + row).text(price * value);
                            $(".grandtotal").text(grandtotal - price);
                            $('.preloader-background').fadeOut('slow');

                        }, error: function (xhr) {
                            M.toast({html: xhr.statusText, classes: ' red lighten-2 white-text'});
                            $('.preloader-background').fadeOut('slow');

                        }
                    });
                }
            }
        }

        function deleteRow(btn, value, total) {
            var url = '{{ route("frontend.remove", ":id") }}';
            url = url.replace(':id', value);
            var row = btn.parentNode.parentNode;
            var totalprice = parseInt($("." + total).text());
            var grandtotal = parseInt($(".grandtotal").text());
            $.ajax({
                url: url,
                method: 'GET',
                beforeSend: function () {
                    $('.preloader-background').show();
                },
                success: function (response) {
                    M.toast({html: response});
                    $(".grandtotal").text(grandtotal - totalprice);
                    row.parentNode.removeChild(row);
                    $('.preloader-background').fadeOut('slow');

                },
                error: function (xhr) {
                    M.toast({html: xhr.statusText, classes: ' red lighten-2 white-text'});
                    $('.preloader-background').fadeOut('slow');

                }
            });
        }
    </script>
@endsection
