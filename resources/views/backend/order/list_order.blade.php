@extends('layouts.master')

@section('title') Order List @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css"/>

@endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') All  Order  @endslot
        @slot('li_1') Pages  @endslot
    @endcomponent


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div style="overflow-x: scroll;">
                        <table id="order-data" class="table table-striped table-bordered dt-responsive"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>User</th>
                                <th>Mobile</th>
                                <th>OrderNumber</th>
                                <th>Pickup</th>
                                <th>Payment</th>
                                <th>Address</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>


                            <tbody>

                            </tbody>
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
        $(function () {

            var table = $('#order-data').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('orders.list') }}",
                columns: [
                    {
                        data: 'created_at',
                        type: 'num',
                        render: {
                            _: 'display',
                            sort: 'timestamp'
                        }
                    },
                    {
                        data: 'created_at',
                        type: 'num',
                        render: {
                            _: 'timestamp',
                            sort: 'timestamp'
                        }
                    },
                    {data: 'frontuser_id', name: 'User'},
                    {data: 'mobile', name: 'Mobile'},
                    {data: 'ordernumber', name: 'OrderNumber'},
                    {data: 'orderpickup', name: 'Pickup'},
                    {data: 'payemttype', name: 'Payment'},
                    {data: 'address_id', name: 'Address'},
                    {data: 'total', name: 'Total'},
                    {data: 'status', name: 'Status'},
                    {data: 'action', name: 'action', orderable: true, searchable: true},
                ]
            });

        });


        $('#order-data').on('click', '.delete', function (e) {
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
                    type: 'DELETE',
                    dataType: 'json',
                    data: {method: '_DELETE', submit: true}
                }).always(function (data) {
                    $('#order-data').DataTable().draw(false);
                });
            }
        });

    </script>

@endsection
