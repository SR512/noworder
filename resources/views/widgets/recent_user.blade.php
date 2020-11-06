<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Today's Register User</h4>

                    @if(count($users))
                    <ul class="inbox-wid list-unstyled">

                    @foreach($users as $list)
                            <li class="inbox-list-item">
                                <a href="#">
                                    <div class="media">
                                        <div class="mr-3 align-self-center">
                                            <img src="{{asset('asset/demo.png')}}" alt="" class="avatar-sm rounded-circle">
                                        </div>
                                        <div class="media-body overflow-hidden">
                                            <h5 class="font-size-16 mb-1">{{$list->name}}</h5>
                                            <p class="text-truncate mb-0">{{$list->mobile}}</p>
                                        </div>
                                        <div class="font-size-12 ml-2">
                                            {{date('D d M-Y', strtotime($list->created_at))}}
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    @else
                            <li class="inbox-list-item">
                                Data No Found..!
                            </li>
                    @endif
                </ul>

                <div class="text-center">
                    <a href="{{route('users.list')}}" class="btn btn-primary btn-sm">Show All</a>
                </div>
            </div>
        </div>
    </div>
</div>
