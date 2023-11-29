@extends('layouts.web')
@section('title')
    {{ Helper::webinfo()->site_title }} | {{ trans('labels.login') }}
@endsection

@section('content')
    <!-- =========================== Login =================================== -->
    <section>
        <div class="container">

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="login_signup">
                        @if (\Session::has('danger'))
                            <div class="alert alert-danger">

                                {{ Session::get('danger') }}

                            </div>
                        @endif

                        @if (\Session::has('success'))
                            <div class="alert alert-success">

                                {{ Session::get('success') }}

                            </div>
                        @endif
                        <h3 class="login_sec_title">{{ trans('labels.login') }}</h3>
                        <form action="{{ URL::to('login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>{{ trans('labels.email') }}</label>
                                <input type="text" name="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>{{ trans('labels.password') }}</label>
                                <div class="input-group" id="show_hide_password">
                                    <input name="password" class="form-control" type="password">
                                    <div class="input-group-addon">
                                        <a href=""><i class="fa fa-eye-slash"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="login_flex">
                                <div class="login_flex_1">
                                    {{ trans('labels.new_user') }} <a href="{{ URL::to('/signup') }}"
                                        class="text-bold">{{ trans('labels.create_account') }}</a>
                                </div>
                                <div class="login_flex_2">
                                    <a href="{{ URL::to('/forgot-password') }}"
                                        class="text-bold">{{ trans('labels.forgot_password') }}</a>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit"
                                    class="btn btn-md btn-theme col-md-12 mt-3">{{ trans('labels.login') }}</button>
                                <!--<div class="text-center">-->
                                <!--<a href="{{ url('auth/google') }}" class="btn btn-primary col-md-5 mt-3 mr-3" style="background-color: #fff;">-->
                                <!--    <img src='{{ asset('storage/app/public/Webassets/img/ic_google.png') }}' alt="">-->
                                <!--</a>-->
                                <!--<a href="{{ url('auth/facebook') }}" class="btn btn-primary col-md-5 mt-3" style="background-color: #fff;">-->
                                <!--    <img src='{{ asset('storage/app/public/Webassets/img/ic_fb.png') }}' alt="">-->
                                <!--</a>-->
                                <!--</div>-->
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- =========================== Login/Signup =================================== -->
@endsection
@section('scripttop')
    <script type="text/javascript">

        $('.input-group-addon').on('click', function(e) {
            e.preventDefault()

            if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass( "fa-eye-slash" );
                    $('#show_hide_password i').removeClass( "fa-eye" );
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password i').addClass( "fa-eye" );
                }
        })

    </script>
@endsection
