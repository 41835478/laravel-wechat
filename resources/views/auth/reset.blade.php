<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 8/21/15
 * Time: 3:23 PM
 */
 ?>
 @extends('layouts.master')
 @section('container')
 <div class="login-container">

     <div class="row">

         <div class="col-sm-6">

             <!-- Errors container -->
             <div class="errors-container">
                @if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
             </div>

             <!-- Add class "fade-in-effect" for login form effect -->
             {!! Form::open(['url' => ['/password/reset'],'method'=>'POST','id'=>'login','class'=>'login-form validate','novalidate'=>'novalidate']) !!}
                 {!! Form::hidden('token',$token)!!}
                 <div class="login-header">
                     <a href="{{url('/')}}" class="logo">
                         {!! Html::image("wechat/images/logo.jpg",null,['width'=>'80']) !!}
                         <span>重置密码</span>
                     </a>

                     <p>请设置您的新密码!</p>
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
                         重置密码
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