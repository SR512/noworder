@extends('layouts.master')


@section('title') Slider @endsection
@section('css')

    <link href="{{URL::asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{URL::asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
@endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') Slider  @endslot
        @slot('li_1') Pages  @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('sliders.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">{{ __('Title Name') }}</label>
                                    <input type="text" name="title" value="{{ old('title') }}"
                                           autocomplete="name"
                                           class="form-control @error('title') is-invalid @enderror" autofocus
                                           id="name" placeholder="Enter title">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subtitle">{{ __('Sub Title') }}</label>
                                    <input type="text" name="subtitle" value="{{ old('subtitle') }}"
                                           autocomplete="subtitle"
                                           class="form-control @error('subtitle') is-invalid @enderror" autofocus
                                           id="name" placeholder="Enter Subtitle">
                                    @error('subtitle')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo">{{ __('Image') }}</label>
                                    <input type="file" name="photo"
                                           class="form-control @error('photo') is-invalid @enderror">
                                    @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary btn-sm waves-effect waves-light" id="register"
                                    type="submit"> {{ __('Create Slider') }}</button>
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
