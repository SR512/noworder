@extends('layouts.master')


@section('title') Edit Item @endsection
@section('css')

    <link href="{{URL::asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{URL::asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
@endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') Edit Item  @endslot
        @slot('li_1') Pages  @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('items.update',$item->id) }}" enctype="multipart/form-data">
                        @csrf
                         @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">{{ __('Category Name') }}</label>
                                    <select  class="form-control @error('category') is-invalid @enderror" name="category">
                                        <option value="0">Select Category</option>
                                        @if(isset($categories))
                                            @foreach($categories as $list)
                                                <option value="{{$list->id}}" {{$list->id == $item->category_id ?'selected':''}}>{{$list->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="itemtype">{{ __('Item Type') }}</label>
                                    <select class="form-control @error('itemtype') is-invalid @enderror" onchange="isItemtype(this.value)" name="itemtype">
                                        <option value="0">Choose</option>
                                        <option value="regular" {{$item->itemtype == 'regular' ?'selected':''}}>Regular</option>
                                        <option value="attribute" {{$item->itemtype == 'attribute' ?'selected':''}}>Attribute</option>
                                    </select>
                                    @error('itemtype')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">{{ __('Item Title') }}</label>
                                    <input type="text" name="title" value="{{  $item->title }}"
                                           autocomplete="title"
                                           class="form-control @error('title') is-invalid @enderror"
                                           autofocus
                                           id="title" placeholder="Enter title">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="caption">{{ __('Item Caption') }}</label>
                                    <input type="text" name="caption" value="{{ $item->caption }}"
                                           autocomplete="caption"
                                           class="form-control @error('caption') is-invalid @enderror"
                                           autofocus
                                           id="caption" placeholder="Enter caption">
                                    @error('caption')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Menu_Image">{{ __('Item Image') }}</label>
                                    <input type="file" name="Menu_Image"
                                           class="form-control @error('Menu_Image') is-invalid @enderror">
                                    @error('Menu_Image')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 itemprice" {{$item->itemtype  != 'regular' ? "style=display:none;":"style=display: block;"}}>
                                <div class="form-group">
                                    <label for="price">{{ __('Item Price') }}</label>
                                    <input type="number" name="price" value="{{ $item->price}}"
                                           autocomplete="price"
                                           class="form-control @error('price') is-invalid @enderror"
                                           autofocus
                                           id="price" placeholder="Enter Price">
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 dicount" {{$item->itemtype  != 'regular' ? "style=display:none;":"style=display: block;"}}>
                                <div class="form-group">
                                    <label for="discount">{{ __('Discount') }}</label>
                                    <select class="form-control @error('discount') is-invalid @enderror" onchange="isDiscount(this.value)" name="discount">
                                        <option value="0">Choose</option>
                                        <option value="Yes" {{$item->discount == 'Yes' ?'selected':''}}>Yes</option>
                                        <option value="No" {{$item->discount == 'No' ?'selected':''}}>No</option>
                                    </select>
                                    @error('discount')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 discountprice" {{$item->discount != 'Yes' ? "style=display:none;":"style=display: block;"}}>
                                <div class="form-group">
                                    <label for="discountprice">{{ __('Discount Price') }}</label>
                                    <input type="number" name="discountprice" value="{{ $item->discountprice }}"
                                           autocomplete="discountprice"
                                           class="form-control @error('discountprice') is-invalid @enderror"
                                           autofocus
                                           id="discountprice" placeholder="Enter Discount Price">
                                    @error('discountprice')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">{{ __('Item Description') }}</label>
                                    <textarea name="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              autofocus
                                              id="description-ckeditor"
                                              placeholder="Enter description">{!! $item->description !!}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary btn-sm waves-effect waves-light" id="register"
                                    type="submit"> {{ __('Update Item') }}</button>
                        </div>

                    </form>

                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
    <!-- end row -->
@endsection
@section('script')

    <!-- parsley plugin -->
    <script src="{{URL::asset('/libs/parsleyjs/parsleyjs.min.js')}}"></script>
    <!-- validation init -->
    <script src="{{URL::asset('/js/pages/form-validation.init.js')}}"></script>
    <script src="{{URL::asset('/libs/select2/select2.min.js')}}"></script>
    <script src="{{URL::asset('/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- form advanced init -->

    <script type="text/javascript">
        function isDiscount(value) {
            if (value == 'Yes') {
                $(".discountprice").show();
            } else {
                $("#discountprice").val(" ");
                $(".discountprice").hide();
            }
        }

        function isItemtype(value) {
            if (value == 'regular') {
                $(".dicount").show();
                $(".itemprice").show();
            } else {
                $(".dicount").hide();
                $(".itemprice").hide();
            }
        }
    </script>
    <script src="{{URL::asset('/js/pages/form-advanced.init.js')}}"></script>
@endsection
