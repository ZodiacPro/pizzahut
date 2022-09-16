@extends('layouts.app', ['class' => 'login-page', 'page' => __('Login Page'), 'contentClass' => 'login-page'])

@section('content')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-3 mt-5 pt-4 pl-2 pr-2">
        <form class="form" method="post" action="{{ route('login') }}">
            @csrf

            <div class="card card-login card-white" style="background-color:rgba(42, 52, 56, 0.861);">
                {{-- <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12">
                            {{-- <img src="{{ asset('black') }}/img/white-logo.png" alt=""> --}}
                        {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- <h1 class="card-title">{{ __('E-Formula') }}</h1> --}}
                {{-- </div> --}}
                <div class="card-body">
                    <div class="row text-center mt-4 mb-4">
                        <div class="col-sm-12 text-center">
                            <img src="{{ asset('black') }}/img/white-logo.png" alt="" style="width: 150px">
                        </div>
                    </div>
                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }} pr-3 pl-3 mt-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text border-left border-top border-bottom">
                                <i class="fa-solid fa-envelope font-weight-bold" style="color:white"></i>
                            </div>
                        </div>
                        <input type="text" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} border-right border-top border-bottom" placeholder="{{ __('Email') }}">
                        @include('alerts.feedback', ['field' => 'email'])
                    </div>
                    <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }} pr-3 pl-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text border-left border-top border-bottom">
                                <i class="fa-solid fa-lock font-weight-bold" style="color:white"></i>
                            </div>
                        </div>
                        <input type="password" placeholder="{{ __('Password') }}" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} border-right border-top border-bottom">
                        @include('alerts.feedback', ['field' => 'password'])
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" href="" class="btn btn-sm mb-3" style="background: transparent;border:2px solid rgb(59, 158, 59);color:gb(3, 215, 3);">{{ __('Login') }}</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-7"></div>
</div>
@endsection
