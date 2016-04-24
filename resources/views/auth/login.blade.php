<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 8/21/15
 * Time: 9:32 AM
 * Description: login page
 */
 ?>
@extends('layouts.master')
@section('container')
<div class="login-container">

    <div class="row">

        <div class="col-sm-6">

            <!-- Errors container -->
            <div class="errors-container">

            </div>

            <!-- Add class "fade-in-effect" for login form effect -->
            {!! Form::open(array('url' => array('auth/login'),'method'=>'POST','id'=>'login','class'=>'login-form validate','novalidate'=>'novalidate')) !!}
                <div class="login-header">
                    <a href="{{url('/')}}" class="logo">
                        {!! Html::image("style/assets/images/logo@2x.png",null,['width'=>'80']) !!}
                        <span>登录</span>
                    </a>

                    <p>您好, 请登录进行更好的体验!</p>
                </div>


                <div class="form-group">
                    {!! Form::label('email', '',['class' => 'control-label']) !!}
                    {!! Form::text('email', old('email'), ["class"=>"form-control input-dark", "id"=>"email","data-validate"=>"required", "data-message-required"=>"这是必填项"]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', '',['class' => 'control-label']) !!}
                    {!! Form::password('password', ["class"=>"form-control input-dark", "id"=>"password","data-validate"=>"required", "data-message-required"=>"这是必填项"]) !!}
                    </div>
                <div class="form-group">
                    {!! Form::checkbox('remember') !!}
                    {!! Form::label('remember', '记住密码') !!}
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-dark  btn-block text-left">
                        <i class="fa-lock"></i>
                        登录
                    </button>
                </div>

                <div class="login-footer">
                    <a href="{{url('password/email')}}">忘记密码?</a>

                </div>

            {!! Form::close() !!}

            <!-- External login -->
            {{--<div class="external-login">--}}
                {{--<a href="#" class="facebook">--}}
                    {{--<i class="fa-facebook"></i>--}}
                    {{--Facebook Login--}}
                {{--</a>--}}

                {{--<a href="#" class="twitter">--}}
                    {{--<i class="fa-twitter"></i>--}}
                    {{--Login with Twitter--}}
                {{--</a>--}}

                {{--<a href="#" class="gplus">--}}
                    {{--<i class="fa-google-plus"></i>--}}
                    {{--Login with Google Plus--}}
                {{--</a>--}}

            {{--</div>--}}

        </div>

    </div>

</div>
@stop

@section('script')
{!! Html::script("style/assets/js/jquery-validate/jquery.validate.min.js") !!}
@stop