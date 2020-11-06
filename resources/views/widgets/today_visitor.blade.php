<div class="row">

    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Today's Visitor ({{count($visitors)}})</h4>
                <div class="table-responsive">
                    <table class="table table-centered">
                        <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Country</th>
                            <th scope="col">Region Name</th>
                            <th scope="col">City</th>
                            <th scope="col">Zip Code</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($visitors) != 0)

                            @foreach($visitors as $list)
                                <tr>
                                    <td>{{\Carbon\Carbon::parse($list->created_at)->diffForhumans()}}</td>
                                    <td>{{\Carbon\Carbon::parse($list->created_at)->diffForhumans()}}</td>
                                    <td>{{$list->countryName}}</td>
                                    <td>{{$list->regionName}}</td>
                                    <td>{{$list->cityName}}</td>
                                    <td>{{$list->zipCode}}</td>
                                </tr>

                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">Not Visitor Data Found.</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
