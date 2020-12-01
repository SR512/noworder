@extends('layouts.master')


@section('title') Edit Item Attribute @endsection
@section('css')

    <link href="{{URL::asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{URL::asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
@endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') Edit Item Attribute  @endslot
        @slot('li_1') Pages  @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('attributevalues.update',$attributeitem->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="attribute">{{ __('Attribute') }}</label>
                                    <select  class="form-control @error('attribute') is-invalid @enderror" name="attribute">
                                        <option value="0">Select Attribute</option>
                                        @if(isset($attributes))
                                            @foreach($attributes as $list)
                                                <option value="{{$list->id}}" {{$attributeitem->attribute_id == $list->id?'selected':''}}>{{$list->attribute}}</option>
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
                                    <label for="item">{{ __('Item') }}</label>
                                    <select  class="form-control @error('item') is-invalid @enderror" name="item">
                                        <option value="0">Select Item</option>
                                        @if(isset($items))
                                            @foreach($items as $list)
                                                <option value="{{$list->id}}" {{$attributeitem->item_id == $list->id?'selected':''}}>{{$list->title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('item')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="value">{{ __('Value') }}</label>
                                    <input type="text" name="value" value="{{$attributeitem->value}}"
                                           autocomplete="value"
                                           class="form-control @error('name') is-invalid @enderror" autofocus
                                           id="value" placeholder="Enter value">
                                    @error('value')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">{{ __('Price') }}</label>
                                    <input type="text" name="price" value="{{ $attributeitem->price }}"
                                           autocomplete="price"
                                           class="form-control @error('price') is-invalid @enderror" autofocus
                                           id="price" placeholder="Enter Price">
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary btn-sm waves-effect waves-light" id="register"
                                    type="submit"> {{ __('Update Attribute') }}</button>
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
    <script src="{{URL::asset('/js/pages/form-advanced.init.js')}}"></script>
@endsection
