<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 8/21/15
 * Time: 3:14 PM
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
             {!! Form::open(array('url' => array('/password/email'),'method'=>'POST','id'=>'login','class'=>'login-form validate','novalidate'=>'novalidate')) !!}
                 <div class="login-header">
                     <a href="{{url('/')}}" class="logo">
                         {!! Html::image("style/assets/images/logo@2x.png",null,['width'=>'80']) !!}
                         <span>找回密码</span>
                     </a>

                     <p>忘记密码? 不用怕，找回密码请输入注册邮箱哦</p>
                 </div>


                 <div class="form-group">
                     {!! Form::label('email', 'Email',['class' => 'control-label']) !!}
                     {!! Form::text('email', old('email'), ["class"=>"form-control input-dark", "id"=>"email","data-validate"=>"required", "data-message-required"=>"这是必填项"]) !!}
                 </div>

                 <div class="form-group">
                     <button type="submit" class="btn btn-dark  btn-block text-left">
                         <i class="fa-lock"></i>
                         发送邮件
                     </button>
                 </div>

             {!! Form::close() !!}

         </div>

     </div>

 </div>
 @stop

 @section('script')
 {!! Html::script("assets/js/jquery-validate/jquery.validate.min.js") !!}
 @stop