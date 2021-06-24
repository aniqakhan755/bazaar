@extends('core/base::layouts.base')

@section('body-class') login @stop
@section('body-style') background-image: url({{ get_login_background() }}); @stop

@push('header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="/vendor/core/core/base/libraries/select2/css/select2.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="/vendor/core/core/base/libraries/select2/css/select2-bootstrap.min.css">
    <style>
        .register-container{
            top: 25% !important;
        }
        .fieldset-heading {
            text-align: left;
            font-weight: 700;
            margin-bottom: 5px;
            margin-top: 3px;
            color: #757c85;
            border-radius: 2px;
            font-size: 12px;
            text-transform: uppercase;
            width: auto;
            padding-left: 2px;
        }
        .required:after {
            content: " *";
            color: red;
        }
        .register-title{
            font-size: 1.6rem;
        }
        .btn-style{
            display: block;
            text-align: center;
            color: #eee!important;
            padding: 12px 20px;
            outline: 0!important;
            opacity: .8;
            border: 0;
            width: auto;
            border-radius: 2px;
            float: left;
            font-size: 11px;
            font-weight: 400;
            text-transform: uppercase;
            transition: width .3s ease;

        }
        .select--arrow{position:relative}.select--arrow i{position:absolute;top:50%;transform:translateY(-50%);right:10px;color:#ccc}.select--arrow .form-control{padding:0 30px 0 15px;height:40px;-webkit-appearance:none;-moz-appearance:none;-o-appearance:none;appearance:none}@media only screen and (max-width:320px){.checkout-content-wrap{margin-bottom:20px}


    </style>
@endpush
@section ('page')
    <div class="container-fluid">
        <div class="row">
            <div class="faded-bg animated"></div>
            <div class="hidden-xs col-sm-7 col-md-7">
                <div class="clearfix">
                    <div class="col-sm-12 col-md-10 col-md-offset-2">
                        <div class="logo-title-container">
                            <div class="copy animated fadeIn">
                                <h1>{{ setting('admin_title', config('core.base.general.base_name')) }}</h1>
                                <p>{!! clean(trans('core/base::layouts.copyright', ['year' => now()->format('Y'), 'company' => setting('admin_title', config('core.base.general.base_name'))])) !!}</p>
                            </div>
                        </div> <!-- .logo-title-container -->
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-5 col-md-5 login-sidebar">

                <div class="login-container register-container">

                    @yield('content')

                    <div style="clear:both"></div>

                </div> <!-- .login-container -->

            </div> <!-- .login-sidebar -->
        </div> <!-- .row -->
    </div>
@stop
