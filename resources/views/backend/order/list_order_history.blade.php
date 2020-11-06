@extends('layouts.master')

@section('title') Order History @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css"/>

@endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') Order History  @endslot
        @slot('li_1') Pages  @endslot
    @endcomponent


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5><b>Order No: #{{$orderDeatail->ordernumber}}</b></h5>
                    <h6 class="right text-muted"><b>Customer: {{$orderDeatail->getFrontendUser->name}}</b></h6>
                    <h6 class="right text-muted"><b>Mobile: {{$orderDeatail->getFrontendUser->mobile}}</b></h6>
                    <div style="overflow-x: auto">
                        <table  class="table table-striped table-bordered dt-responsive"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($orderhistories))
                            @php($grandtotal=0)
                                @foreach($orderhistories as $list)
                                <tr>
                                    <td>{{\Carbon\Carbon::parse($list->created_at)->diffForhumans()}}</td>
                                    <td>{{$list->name}}</td>
                                    <td>{{$list->qty}}</td>
                                    <td>{{$list->price}}</td>
                                    <td>{{$list->price * $list->qty}}</td>
                                    <td><button href="javascript:void(0)" data-route="{{route('orders.history', $list->id) }}" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i>Delete</button></td>
                                    @php($grandtotal= ($list->price * $list->qty) + $grandtotal)

                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                             <tr>
                                 <td><h4><b>Grand Total</b></h4></td>
                                 <td><h4><b>&#8377;&nbsp;{{$grandtotal}}/-</b></h4></td>
                             </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <!-- end row -->
@endsection
@section('script')

    <script src="{{ URL::asset('/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{ URL::asset('/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{ URL::asset('/libs/pdfmake/pdfmake.min.js')}}"></script>

    <!-- Datatable init js -->
    <script src="{{ URL::asset('/js/pages/datatables.init.js')}}"></script>
    <script type="text/javascript">

        $('.delete').on('click', function (e) {
            e.preventDefault();

            if (confirm('Are You Sure Delete..??')) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = $(this).data('route');
                // confirm then
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    data: {method: 'GET', submit: true}
                }).always(function (data) {
                    location.reload();
                });
            }
        });

    </script>

@endsection
