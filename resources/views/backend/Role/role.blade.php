@extends('layouts.master')


@section('title') Role @endsection
@section('css')

    <link href="{{URL::asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{URL::asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
@endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') Role  @endslot
        @slot('li_1') Pages  @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">{{ __('Role Names') }}</label>
                                <input type="name" name="name" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}" id="name" placeholder="Role Name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        {{--<div class="col-md-6">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="permissions">{{ __('Permissions') }}</label>--}}
                                {{--<select--}}
                                    {{--class="form-control select2 select2-multiple @error('permissions') is-invalid @enderror"--}}
                                    {{--name="permissions[]" id="permissions" multiple>--}}
                                    {{--<option value="0">Choose</option>--}}

                                {{--</select>--}}
                                {{--@error('permissions')--}}
                                {{--<span class="invalid-feedback" role="alert">--}}
                                            {{--<strong>{{ $message }}</strong>--}}
                                        {{--</span>--}}
                                {{--@enderror--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <br/>
                        <div class="col-md-6">
                            <div>
                                <h5 class="font-size-14 mb-4">Permissions</h5>

                                @if($permissions)
                                    @foreach($permissions as $permissions)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="{{$permissions->id}}" name="permissions[]" id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                {{$permissions->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary btn-sm waves-effect waves-light" id="register"
                                    type="submit"> {{ __('Create Role') }}</button>
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

    <!-- form advanced init -->
    <script src="{{URL::asset('/js/pages/form-advanced.init.js')}}"></script>
@endsection
