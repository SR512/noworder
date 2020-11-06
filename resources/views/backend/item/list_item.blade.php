@extends('layouts.master')

@section('title') Item List @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css"/>

@endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') All  Item  @endslot
        @slot('li_1') Pages  @endslot
    @endcomponent


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div>
                        <table id="item-data" class="table table-striped table-bordered dt-responsive"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Discount</th>
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

            var table = $('#item-data').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('items.list') }}",
                columns: [
                    {data: 'image', name: 'Image'},
                    {data: 'category_id', name: 'Category'},
                    {data: 'title', name: 'Name'},
                    {data: 'price', name: 'Price'},
                    {data: 'discount', name: 'Discount'},
                    {data: 'status', name: 'Status'},
                    {data: 'action', name: 'action', orderable: true, searchable: true},
                ]
            });

        });


        $('#item-data').on('click', '.delete', function (e) {
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
                    $('#item-data').DataTable().draw(false);
                });
            }
        });

    </script>

@endsection
