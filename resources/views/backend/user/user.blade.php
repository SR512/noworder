@extends('layouts.master')


@section('title') User @endsection
@section('css')

    <link href="{{URL::asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{URL::asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
@endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') User  @endslot
        @slot('li_1') Pages  @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   autocomplete="name"
                                   class="form-control @error('name') is-invalid @enderror" autofocus
                                   id="name" placeholder="Enter name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="restaurunt_name">{{ __('Restaurunt Name') }}</label>
                            <input type="text" name="restaurunt_name" value="{{ old('restaurunt_name') }}" required
                                   autocomplete="restaurunt_name"
                                   class="form-control @error('restaurunt_name') is-invalid @enderror"
                                   autofocus
                                   id="restaurunt_name" placeholder="Enter Owner Name">
                            @error('restaurunt_name')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="useremail">{{ __('Mobile No') }}</label>
                            <input type="number" name="mobile"
                                   class="form-control @error('mobile') is-invalid @enderror"
                                   name="mobile" value="{{ old('mobile') }}" id="mobile"
                                   placeholder="Enter Mobile" autocomplete="mobile">
                            @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="useremail">{{ __('E-Mail Address') }}</label>
                            <input type="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" id="useremail"
                                   placeholder="Enter email" autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="userpassword">{{ __('Password') }}</label>
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="new-password"
                                   id="userpassword" placeholder="Enter password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="userpassword">{{ __('Confirm Password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                   id="userconfirmpassword" placeholder="Confirm password">
                        </div>

                        <div class="form-group">
                            <label for="role">{{ __('Role') }}</label>
                            <select
                                class="form-control  @error('role') is-invalid @enderror"
                                name="roles[]" id="role">
                                <option value="0">Choose</option>
                                @if($roles)
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('roles')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>


                        <div class="mt-4">
                            <button class="btn btn-primary btn-sm waves-effect waves-light" id="register"
                                    type="submit"> {{ __('Create User') }}</button>
                        </div>

                    </form>

                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
    <!-- end row -->
@endsection
@section('script')

    <!-- parsley plugin -->
    <script src="{{URL::asset('/libs/parsleyjs/parsleyjs.min.js')}}"></script>
    <!-- validation init -->
    <script src="{{URL::asset('/js/pages/form-validation.init.js')}}"></script>
    <script src="{{URL::asset('/libs/select2/select2.min.js')}}"></script>
    <script src="{{URL::asset('/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('input[name="movie_releasedate"]').datepicker({

                orientation: "bottom auto"
            });
        });


        $("#find-movie").submit(function (e) {
            e.preventDefault();
            var query = $("#query").val();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {query: query},
                success: function (response) {
                    $("#movie_title").val(response.data['title']);
                    $('#movie_genre').val(response.data['genre']).trigger('change');
                    $('#movie_language').val(response.data['language']).trigger('change');
                    $('#movie_cast').val(response.data['actor']).trigger('change');
                    $("#movie_plot").val(response.data['plot']);
                    $("#movie_rating").val(response.data['rating']);
                    //$("#movie_releasedate").val(response.data['relesedate']);
                    $("#movie_runtime").val(response.data['runtime']);
                }
            });

        })
    </script>
    <!-- form advanced init -->
    <script src="{{URL::asset('/js/pages/form-advanced.init.js')}}"></script>
@endsection
