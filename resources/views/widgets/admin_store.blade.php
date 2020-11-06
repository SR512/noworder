<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Today's Register Store ({{count($stores)}})</h4>
                <div class="table-responsive">
                    <table class="table table-centered">
                        <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Category</th>
                            <th scope="col">Name</th>
                            <th scope="col">Store</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Address</th>
                            <th scope="col">State</th>
                            <th scope="col">City</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($stores) != 0)

                            @foreach($stores as $list)
                                <tr>
                                    <td>{{date('D d M-Y', strtotime($list->created_at))}}</td>
                                    <td>{{date('H:m:s a', strtotime($list->created_at))}}</td>
                                    <td>{{$list->getCategory->name}}</td>
                                    <td>{{$list->name}}</td>
                                    <td>{{$list->businessname}}</td>
                                    <td>{{$list->mobile}}</td>
                                    <td>{{$list->address}}</td>
                                    <td>{{$list->state}}</td>
                                    <td>{{$list->city}}</td>
                                    <td><a href="{{route('users.show', $list->id)}}" class="btn btn-primary">View</a>
                                    </td>
                                </tr>

                            @endforeach
                        @else
                            <tr>
                                <td colspan="10" class="text-center">Not Store Data Found.</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <a href="{{route('user.home')}}" class="btn btn-primary btn-sm">Show All Store</a>
                </div>
            </div>
        </div>
    </div>
</div>
