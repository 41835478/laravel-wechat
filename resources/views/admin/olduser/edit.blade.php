@extends('layouts.admin.admin')

 @section('flash-message')
 @if (Session::has('flash_notification.message'))
     <div class="alert alert-{{ Session::get('flash_notification.level') }}">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

         {{ Session::get('flash_notification.message') }}
     </div>
 @endif
 @stop
@section('content')

<div class="row">
<div class="col-sm-12">
    
<div class="panel panel-default">
<div class="panel-heading">
    <h3 class="panel-title">用户信息</h3>
    <div class="panel-options">
        <a href="#" data-toggle="panel">
            <span class="collapse-icon">&ndash;</span>
            <span class="expand-icon">+</span>
        </a>
        <a href="#" data-toggle="remove">
            &times;
        </a>
    </div>
</div>
<div class="panel-body">
    
    {!! Form::open(['route'=>['admin.wechat-user.update',$user->us_id],'role'=>'form','class'=>'form-horizontal','method'=>'patch']) !!}

        <div class="form-group-separator"></div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="signature">头像</label>

            <div class="col-sm-10">
                <img src="{{ $user->us_portrait }}" width="64"/>
            </div>
        </div>

        <div class="form-group @if($errors->first('us_nick')) has-error @endif">
            <label class="col-sm-2 control-label" for="us_nick" >昵称</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" name="us_nick" id="us_nick" value="{{ $user->us_nick }}" placeholder="@if($errors->first('us_nick')) {{$errors->first('us_nick')}} @else 昵称 @endif">
            </div>
        </div>

        <div class="form-group-separator"></div>
        <div class="form-group @if($errors->first('us_gender')) has-error @endif">
            <label class="col-sm-2 control-label">性别</label>

            <div class="col-sm-10">

                <p>
                    <label class="radio-inline">
                        <input type="radio" name="us_gender" value="1" @if($user->us_gender==1) checked @endif>
                        男
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="us_gender" value="2" @if($user->us_gender==2) checked @endif>
                        女
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="us_gender" value="0" @if($user->us_gender==0) checked @endif>
                        保密
                    </label>
                    @if($errors->first('us_gender')) {{$errors->first('us_gender')}} @endif
                </p>

            </div>
        </div>

        <div class="form-group-separator"></div>

        <div class="form-group @if($errors->first('us_tel')) has-error @endif">
            <label class="col-sm-2 control-label" for="us_tel">联系电话</label>

            <div class="col-sm-10">
                <input type="text" name="us_tel" id="us_tel" value="{{$user->us_tel}}" class="form-control" placeholder="@if($errors->first('us_tel')) {{$errors->first('us_tel')}} @else 联系电话 @endif">
            </div>
        </div>

        <div class="form-group-separator"></div>

        <div class="form-group @if($errors->first('us_age')) has-error @endif">
            <label class="col-sm-2 control-label" for="us_age">客户年龄</label>

            <div class="col-sm-10">
                <input type="text" name="us_age" id="us_age" value="{{$user->us_age}}" class="form-control" placeholder="@if($errors->first('us_age')) {{$errors->first('us_age')}} @else 客户年龄 @endif">
            </div>
        </div>

        <div class="form-group-separator"></div>

        <div class="form-group @if($errors->first('us_carno')) has-error @endif">
            <label class="col-sm-2 control-label" for="us_carno">车架号</label>

            <div class="col-sm-10">
                <input type="text" name="us_carno" id="us_carno" value="{{$user->us_carno}}" class="form-control" placeholder="@if($errors->first('us_carno')) {{$errors->first('us_carno')}} @else 车架号 @endif">
            </div>
        </div>

        {{--<div class="form-group-separator"></div>--}}

        {{--<div class="form-group @if($errors->first('us_tel')) has-error @endif">--}}
            {{--<label class="col-sm-2 control-label" for="us_tel">验证车架号</label>--}}

            {{--<div class="col-sm-10">--}}
                {{--<input type="text" name="us_tel" id="us_tel" value="{{$user->us_tel}}" class="form-control" placeholder="@if($errors->first('us_tel')) {{$errors->first('us_tel')}} @else 联系电话 @endif">--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="form-group-separator"></div>

        <div class="form-group @if($errors->first('us_homeland')) has-error @endif">
            <label class="col-sm-2 control-label" for="us_homeland">籍贯</label>

            <div class="col-sm-10">
                <input type="text" name="us_homeland" id="us_homeland" value="{{$user->us_homeland}}" class="form-control" placeholder="@if($errors->first('us_homeland')) {{$errors->first('us_homeland')}} @else 籍贯 @endif">
            </div>
        </div>

        <div class="form-group-separator"></div>

        <div class="form-group @if($errors->first('us_integral')) has-error @endif">
            <label class="col-sm-2 control-label" for="us_integral">客户积分</label>

            <div class="col-sm-10">
                <input type="text" name="us_integral" id="us_integral" value="{{$user->us_integral}}" class="form-control" placeholder="@if($errors->first('us_integral')) {{$errors->first('us_integral')}} @else 客户积分 @endif">
            </div>
        </div>

        <div class="form-group-separator"></div>

        <div class="form-group @if($errors->first('is_banned')) has-error @endif">
            <label class="col-sm-2 control-label">状态</label>

            <div class="col-sm-10">

                <p>
                <label class="radio-inline">
                    <input type="radio" name="us_state" value="0" @if($user->us_state==0) checked @endif>
                        正常
                </label>
                <label class="radio-inline">
                    <input type="radio" name="us_state" value="1" @if($user->us_state==1) checked @endif>
                        归档
                </label>
                @if($errors->first('us_state')) {{$errors->first('us_state')}} @endif
                </p>

            </div>
        </div>

        <div class="form-group-separator"></div>

        <div class="form-group">
            <label class="col-sm-2 control-label"></label>

            <div class="col-sm-10">

                <button class="btn btn-danger">更新</button>

            </div>
        </div>

    {!! Form::close()!!}
</div>
</div>
    
</div>
</div>
@stop
