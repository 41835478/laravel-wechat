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
                        <th width="80%">{{$order->ou_name}}</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="sparkline alum2010-2">
                                客户电话
                            </div>
                        </td>
                        <td>
                            <div class="sparkline nick2010-2">
                                {{$order->ou_tel}}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="sparkline alum2010-2">
                                车牌号
                            </div>
                        </td>
                        <td>
                            <div class="sparkline nick2010-2">
                                {{$order->ou_carno}}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="sparkline alum2011-2">
                                预约时间
                            </div>
                        </td>
                        <td>
                            <div class="sparkline nick2011-2">
                                {{$order->ou_date}}
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
                                {{$order->station->stationname}}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="sparkline alum2012-2">
                                保养公里数
                            </div>
                        </td>
                        <td>
                            <div class="sparkline nick2012-2">
                                {{$order->ou_km}}
                            </div>
                        </td>
                    </tr>
                </table>
                
            </div>
        </div>
        
    </div>
</div>
@stop
