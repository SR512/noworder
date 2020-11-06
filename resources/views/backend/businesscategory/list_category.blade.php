@extends('layouts.master')

@section('title') Category @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css"/>

@endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') All  Category  @endslot
        @slot('li_1') Pages  @endslot
    @endcomponent


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table id="category-data" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Stauts</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
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

            var table = $('#category-data').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('businesscategories.list') }}",
                columns: [
                    {data: 'name', name: 'Name'},
                    {data: 'status', name: 'Status'},
                    {data: 'action', name: 'action', orderable: true, searchable: true},
                ]
            });

        });

        $('#category-data').on('click', '.delete', function (e) {
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
                    $('#category-data').DataTable().draw(false);
                });
            }
        });

    </script>

@endsection
