<div class="container">
    <div class="section">
        <h5 class="pagetitle">Products</h5>
    </div>
</div>
<div class="container">
    <div class="section">

        <div class="row ui-mediabox  prods prods-boxed   medium-left aligned ">

            @if(isset($items))
                @foreach($items as $list)
                    <div class="col s12">
                        <div class="prod-img-wrap">

                            @if($list->image != null)
                                <a class="img-wrap" href="{{asset('asset/Item/'.$list->image)}}" data-fancybox="images"
                                   data-caption="Wooden Teak Lamp"
                                   style="background-image: url('{{asset('asset/Item/'.$list->image)}}');">&nbsp;</a>

                            @else
                                <a class="img-wrap" href="{{asset('asset/demo.png')}}" data-fancybox="images"
                                   data-caption="Wooden Teak Lamp"
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
                                <a href="{{route('itemDetails',$list->id)}}"><span class="addtowishlist btn-small">View Details</span></a>
                            @endif

                            <div class="spacer-line"></div>


                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".addtocart").on('click', function () {
        var name = $(this).data('name');
        var price = $(this).data('price');
        var itemid = $(this).data('itemid');
        var _token = "{{csrf_token()}}";
        var qty = $(this).data('qty');
        var image = $(this).data('image');

        $.ajax({
            url: '{{route('frontend.addtocart')}}',
            method: 'POST',
            data: {
                name: name, price: price
                , qty: qty, itemid: itemid, _token: _token, image: image
            },
            beforeSend: function () {
                $('.preloader-background').show();
            },
            success: function (response) {
                if (response.error) {
                    M.toast({html: response.Message});
                    $('.preloader-background').fadeOut('slow');
                } else {
                    M.toast({html: response.Message, classes: ' red lighten-2 white-text'});
                    $('.preloader-background').fadeOut('slow');

                }
            }, error: function (xhr) {
                M.toast({html: xhr.statusText, classes: ' red lighten-2 white-text'});
                $('.preloader-background').fadeOut('slow');

            }
        });
    });

</script>
