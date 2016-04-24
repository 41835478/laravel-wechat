<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 8/21/15
 * Time: 9:32 AM
 * Description: register page
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
             {!! Form::open(['url' => ['auth/register'],'method'=>'POST','id'=>'login','class'=>'login-form validate','novalidate'=>'novalidate']) !!}
                 <div class="login-header">
                     <a href="{{url('/')}}" class="logo">
                         {!! Html::image("style/assets/images/logo@2x.png",null,['width'=>'80']) !!}
                         <span>注册</span>
                     </a>

                     <p>亲爱的,注册为我们的会员享受更好的服务哦!</p>
                 </div>
                 <div class="form-group">
                     {!! Form::label('name', '用户名',['class' => 'control-label']) !!}
                     {!! Form::text('name', old('name'), ["class"=>"form-control input-dark", "id"=>"name","data-validate"=>"required", "data-message-required"=>"这是必填项"]) !!}
                 </div>

                 <div class="form-group">
                     {!! Form::label('email', 'Email',['class' => 'control-label']) !!}
                     {!! Form::text('email', old('email'), ["class"=>"form-control input-dark", "id"=>"email","data-validate"=>"required", "data-message-required"=>"这是必填项"]) !!}
                 </div>

                 <div class="form-group">
                     {!! Form::label('password', '密码',['class' => 'control-label']) !!}
                     {!! Form::password('password', ["class"=>"form-control input-dark", "id"=>"password","data-validate"=>"required", "data-message-required"=>"这是必填项"]) !!}
                 </div>

                 <div class="form-group">
                     {!! Form::label('password_confirmation', '确认密码',['class' => 'control-label']) !!}
                     {!! Form::password('password_confirmation', ["class"=>"form-control input-dark", "id"=>"password","data-validate"=>"required", "data-message-required"=>"这是必填项"]) !!}
                 </div>

                 <div class="form-group">
                     <button type="submit" class="btn btn-dark  btn-block text-left">
                         <i class="fa-lock"></i>
                         注册
                     </button>
                 </div>

                 <div class="login-footer">
                     <a href="{{url('auth/login')}}">已有账号?</a>

                 </div>

             {!! Form::close() !!}

         </div>

     </div>

 </div>
 @stop

 @section('script')
 {!! Html::script("assets/js/jquery-validate/jquery.validate.min.js") !!}
 @stop
