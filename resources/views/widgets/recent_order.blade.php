<div class="row">

    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Today's Order</h4>
                <div class="table-responsive">
                    <table class="table table-centered">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Date</th>
                            <th scope="col">Order Number</th>
                            <th scope="col">Pickup</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($orders) != 0)

                            @foreach($orders as $list)
                                <tr>
                                    <td><a class="btn btn-sm btn-outline-success"
                                           href="{{route('orders.show',$list->id)}}">View Order</a>
                                    </td>
                                    <td>{{\Carbon\Carbon::parse($list->created_at)->diffForhumans()}}</td>
                                    <td>{{$list->ordernumber}}</td>
                                    <td>
                                        @if($list->orderpickup == 1)
                                            <span class="badge badge-success">Pickup</span>
                                        @else
                                            <span  class="badge badge-danger">Delivery</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($list->payemttype == 1)
                                            <span class="badge badge-success">COD</span>
                                        @else
                                            <span  class="badge badge-danger">Online</span>
                                        @endif
                                    </td>
                                    <td>{{$list->total}}</td>
                                    <td>
                                        @if($list->status == 1)
                                            <span class="badge badge-success">Pending</span>
                                        @elseif($list->status == 2)
                                            <span class="badge badge-success">Order Delivered</span>
                                        @else
                                            <span  class="badge badge-danger">Cancled</span>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">Order Not Found.</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
