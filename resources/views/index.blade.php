@extends('layouts.master')

@section('title') Dashboard @endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') Dashboard   @endslot
        @slot('title_li') Welcome to Dashboard   @endslot
    @endcomponent

    @role('store')

    <div class="row">

        @component('common-components.dashboard-widget')

            @slot('title') Total Order  @endslot
            @slot('iconClass') mdi mdi-tag-plus-outline  @endslot
            @slot('price') {{$orders->count()}}   @endslot

        @endcomponent

        @component('common-components.dashboard-widget')

            @slot('title') Total User  @endslot
            @slot('iconClass') mdi mdi-tag-plus-outline  @endslot
            @slot('price') {{$users->count()}}   @endslot

        @endcomponent
        @component('common-components.dashboard-widget')

            @slot('title') Total Visitors  @endslot
            @slot('iconClass') mdi mdi-tag-plus-outline  @endslot
            @slot('price') {{$visitors->count()}}   @endslot

        @endcomponent

        @component('common-components.dashboard-widget')

            @slot('title') Total Category  @endslot
            @slot('iconClass') mdi mdi-tag-plus-outline  @endslot
            @slot('price') {{$categories->count()}}   @endslot

        @endcomponent

        @component('common-components.dashboard-widget')

            @slot('title') Total Item  @endslot
            @slot('iconClass') mdi mdi-tag-plus-outline  @endslot
            @slot('price') {{$products->count()}}   @endslot

        @endcomponent


    </div>

        @widget('RecentOrder',['count' => 10])
        @widget('RecentUser',['count' => 10])
        @widget('TodayVisitor',['count' => 10])

    @endrole




    <!-- end row -->

    {{--<div class="row">--}}
    {{--<div class="col-xl-5">--}}
    {{--<div class="card">--}}
    {{--<div class="card-body">--}}
    {{--<h4 class="card-title mb-4">Sales Analytics</h4>--}}

    {{--<div class="row align-items-center">--}}
    {{--<div class="col-sm-6">--}}
    {{--<div id="donut-chart" class="apex-charts"></div>--}}
    {{--</div>--}}
    {{--<div class="col-sm-6">--}}
    {{--<div>--}}
    {{--<div class="row">--}}
    {{--<div class="col-6">--}}
    {{--<div class="py-3">--}}
    {{--<p class="mb-1 text-truncate"><i class="mdi mdi-circle text-primary mr-1"></i> Online</p>--}}
    {{--<h5>$ 2,652</h5>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-6">--}}
    {{--<div class="py-3">--}}
    {{--<p class="mb-1 text-truncate"><i class="mdi mdi-circle text-success mr-1"></i> Offline</p>--}}
    {{--<h5>$ 2,284</h5>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-6">--}}
    {{--<div class="py-3">--}}
    {{--<p class="mb-1 text-truncate"><i class="mdi mdi-circle text-warning mr-1"></i> Marketing</p>--}}
    {{--<h5>$ 1,753</h5>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="col-xl-4">--}}
    {{--<div class="card">--}}
    {{--<div class="card-body">--}}
    {{--<h4 class="card-title mb-4">Monthly Sales</h4>--}}

    {{--<div id="scatter-chart" class="apex-charts"></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="col-xl-3">--}}
    {{--<div class="card bg-primary">--}}
    {{--<div class="card-body">--}}
    {{--<div class="text-white-50">--}}
    {{--<h5 class="text-white">2400 + New Users</h5>--}}
    {{--<p>At vero eos et accusamus et iusto odio dignissimos ducimus</p>--}}
    {{--<div>--}}
    {{--<a href="#" class="btn btn-outline-success btn-sm">View more</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row justify-content-end">--}}
    {{--<div class="col-8">--}}
    {{--<div class="mt-4">--}}
    {{--<img src="images/widget-img.png" alt="" class="img-fluid mx-auto d-block">--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    <!-- end row -->

@endsection

@section('script')

    <!-- jquery.vectormap map -->
    <script src="{{ URL::asset('libs/jquery-vectormap/jquery-vectormap.min.js')}}"></script>

    <!-- Calendar init -->
    <script src="{{ URL::asset('js/pages/dashboard.init.js')}}"></script>
@endsection
