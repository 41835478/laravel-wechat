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
                <h3 class="panel-title">详情页</h3>
            </div>
            <div class="panel-body">

                <table class="table table-bordered table-hover text-center middle-align" border="1">
                    <tr>
                        <th width="20%">客户姓名</th>
                        <th width="80%">{{ $order->od_name }}</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="sparkline alum2010-2">
                                客户电话
                            </div>
                        </td>
                        <td>
                            <div class="sparkline nick2010-2">
                                {{ $order->od_tel }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="sparkline alum2010-2">
                                客户性别
                            </div>
                        </td>
                        <td>
                            <div class="sparkline nick2010-2">
                                {{ $order->user->us_gender==1?"男":"女" }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="sparkline alum2011-2">
                                客户年龄
                            </div>
                        </td>
                        <td>
                            <div class="sparkline nick2011-2">
                                {{ $order->user->us_age }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="sparkline alum2011-2">
                                预约状态
                            </div>
                        </td>
                        <td>
                            <div class="sparkline nick2011-2">
                                {{ $order->od_state?"预约中":"已归档" }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="sparkline alum2012-2">
                                客户地址
                            </div>
                        </td>
                        <td>
                            <div class="sparkline nick2012-2">
                                {{ $order->user->us_address }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="sparkline alum2012-2">
                                客户积分
                            </div>
                        </td>
                        <td>
                            <div class="sparkline nick2012-2">
                                {{ $order->user->us_integral }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="sparkline alum2012-2">
                                专营店名称
                            </div>
                        </td>
                        <td>
                            <div class="sparkline nick2012-2">
                                @if($order->station){{ $order->station->stationname }} @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="sparkline alum2012-2">
                                专营店地址
                            </div>
                        </td>
                        <td>
                            <div class="sparkline nick2012-2">
                                @if($order->station){{ $order->station->address }}@endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="sparkline alum2012-2">
                                车型名
                            </div>
                        </td>
                        <td>
                            <div class="sparkline nick2012-2">
                                @if($order->carmodel){{ $order->carmodel->models }}@endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="sparkline alum2012-2">
                                问题留言
                            </div>
                        </td>
                        <td>
                            <div class="sparkline nick2012-2">
                                {{ $order->od_msg }}
                            </div>
                        </td>
                    </tr>
                </table>
                
            </div>
        </div>
        
    </div>
</div>
@stop
