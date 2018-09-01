@extends('layouts.user.mst_user_relog')
@section('title', 'KPP MADYA re:eBerkas - Login First')
@section('content')
    <div style="padding: 3em 0;" id="fh5co-contact">
        <div class="container">
            <div class="row">
                <div class="row animate-box">
                    <div class="col-lg-8 col-lg-offset-2 fh5co-heading">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="w3-panel w3-card">
                                <h2 style="padding-top: 5%" class="text-center">Login First</h2>
                                {{--@if(session('status'))--}}
                                    {{--<div class="alert alert-success alert-dismissible">--}}
                                        {{--<button type="button" class="close" data-dismiss="alert"--}}
                                                {{--aria-hidden="true">--}}
                                            {{--&times;--}}
                                        {{--</button>--}}
                                        {{--<h4><i class="icon fa fa-check"></i> Alert!</h4>--}}
                                        {{--{{session('status')}}--}}
                                    {{--</div>--}}
                                {{--@endif--}}
                                <form style="padding: 5%" method="POST" action="{{ route('login') }}">
                                    {{ csrf_field() }}

                                    <div class="row form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                                        <div class="col-md-12">
                                            <input name="email" type="text" id="email" class="form-control"
                                                   placeholder="E-mail" value="{{ old('email') }}" required autofocus>
                                            {{--<span class="glyphicon glyphicon-envelope form-control-feedback"></span>--}}
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                                        <div class="col-md-12">
                                            <input name="password" type="password" id="password" class="form-control"
                                                   placeholder="Password">
                                            {{--<span class="glyphicon glyphicon-lock form-control-feedback"></span>--}}
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                                <a href="{{ route('password.request') }}">
                                                    Lupa password anda?
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"
                                                       name="remember" {{ old('remember') ? 'checked' : '' }}> Ingat
                                                Saya
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-2">
                                            <input type="submit" value="LOGIN" class="btn btn-primary">
                                        </div>
                                        <div style="padding-left: 5%" class="col-lg-10">
                                            {{--<a class="btn btn-link" href="{{ route('register') }}">--}}
                                                {{--Belum punya akun? Daftar sekarang!--}}
                                            {{--</a>--}}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection