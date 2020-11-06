@extends('layouts.master-without-nav')

@section('title') Thank You @endsection

@section('body')

    <body>
    @endsection

    @section('content')

        <div class="home-btn d-none d-sm-block">
            <a href="index" class="text-dark"><i class="fas fa-home h2"></i></a>
        </div>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">

                            <div class="card-body">

                                <div class="text-center p-3">

                                    <div class="img">
                                        <img src="/images/error-img.png" class="img-fluid" alt="">
                                    </div>

                                    <h1 class="mb-4"><span>Congratulations.!</span></h1>
                                    <h4 class="mb-4 mt-5">Your Account Create Successfully..!</h4>
                                    <p class="mb-4 w-75 mx-auto">We will verify your detail and contact shortly</p>
                                    <a class="btn btn-primary mb-4 waves-effect waves-light"
                                       href="{{route('register.create')}}"><i class="mdi mdi-home"></i> Back to Register</a>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
