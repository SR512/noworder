<div class="row">

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Today's Visitor ({{count($visitordata)}})</h4>
                <div class="table-responsive">
                    <table class="table table-centered">
                        <thead>
                        <tr>
                            <th scope="col">Store</th>
                            <th scope="col">Todays Visitor</th>
                            <th scope="col">Total Visitor</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($visitordata) != 0)

                            @foreach($visitordata as $list)
                                <tr>
                                    <td>{{$list['business']}}</td>
                                    <td>{{$list['visitor']}}</td>
                                    <td>{{$list['total']}}</td>
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
