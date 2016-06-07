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
    <h3 class="panel-title">管理组</h3>
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
    
    {!! Form::open(['route'=>'admin.user.roleStore','role'=>'form','class'=>'form-horizontal','method'=>'post']) !!}
        {!! Form::hidden('user_id',$user->id) !!}
        <div class="form-group">
            <label class="col-sm-2 control-label">管理组</label>

            <div class="col-sm-10">
                <select name="role_id" class="form-control">
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}" @if($user->hasRole($role->name)) selected="selected" @endif>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

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
