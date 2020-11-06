@extends('layouts.master')

@section('title') Item Detail @endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') Item Detail  @endslot
        @slot('li_1') Pages  @endslot
    @endcomponent


    <!-- start row -->
    <div class="row">
        <div class="col-md-12 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="profile-widgets py-3">

                        <div class="text-center">
                            <div class="">
                                <img src="{{asset('asset/Item/'.$item->image)}}" alt=""
                                     class="avatar-lg mx-auto img-thumbnail rounded-circle">
                            </div>

                            <div class="mt-3 ">
                                <a href="#" class="text-dark font-weight-medium font-size-16">{{$item->title}}</a>
                                <p class="text-body mt-1 mb-1">{{$item->businessname}}</p>
                            </div>
                            @if($item->status != 0)
                                <span class="badge badge-success">Show</span>
                            @else
                                <span class="badge badge-danger">Hide</span>
                            @endif
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xl-9">

            <div class="card">
                <div class="card-body">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">Item Detail</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane active" id="settings" role="tabpanel">
                            <div class="mt-3">
                                <p class="font-size-12 text-muted mb-1">Category</p>
                                <h6 class="">{{$item->getCategory->name}}</h6>
                            </div>

                            <div class="mt-3">
                                <p class="font-size-12 text-muted mb-1">Caption</p>
                                <h6 class="">{{$item->caption != null ?$item->caption:'No'}}</h6>
                            </div>

                            <div class="mt-3">
                                <p class="font-size-12 text-muted mb-1">Price</p>
                                <h6 class="">{{$item->price != null ?$item->price:'No'}}</h6>
                            </div>

                            <div class="mt-3">
                                <p class="font-size-12 text-muted mb-1">Discount</p>
                                <h6 class="">{{$item->discount != null ?$item->discount:'No'}}</h6>
                            </div>

                            <div class="mt-3">
                                <p class="font-size-12 text-muted mb-1">Discount Price</p>
                                <h6 class="">{{$item->discountprice != null ?$item->discountprice:'No'}}</h6>
                            </div>

                            <div class="mt-3">
                                <p class="font-size-12 text-muted mb-1">Description</p>
                                <h6 class="">{!! $item->description != null ? $item->description:'No' !!}</h6>
                            </div>


                        </div>

                    </div>
                    </div>

                </div>
            </div>

        </div>


    </div>

    <!-- end row -->
@endsection

@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/libs/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{ URL::asset('/js/pages/profile.init.js')}}"></script>
@endsection
