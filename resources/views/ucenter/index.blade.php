@extends('layouts.ucenter.ucenter')


@section('page-title')
    <div class="page-title">

        <div class="title-env">
            <h1 class="title">微信功能</h1>
            <p class="description">微信基本功能</p>
        </div>

        <div class="breadcrumb-env">

            <ol class="breadcrumb bc-1">
                <li>
                    <a href="dashboard-1.html"><i class="fa-home"></i>个人中心</a>
                </li>
                <li>
                    <a href="extra-gallery.html">微信功能</a>
                </li>
                <li class="active">
                    <strong>关键字管理</strong>
                </li>
            </ol>

        </div>

    </div>
@stop

@section('main')
			<section class="mailbox-env">

             @if (Session::has('flash_notification.message'))
                 <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                     {{ Session::get('flash_notification.message') }}
                 </div>
             @endif

				<div class="row">

					<!-- Inbox emails -->
					<div class="col-sm-9 mailbox-right">

					    <div class="panel-body">

                            <script type="text/javascript">
                                jQuery(document).ready(function($)
                                   {
                                   $("#example-2").dataTable({
                                     dom: "t" + "<'row'<'col-xs-6'i><'col-xs-6'p>>",
                                     aoColumns: [
                                                 {bSortable: false},
                                                 null,
                                                 null,
                                                 null,
                                                 null,
                                                 null,
                                                 null,
                                                 null
                                                 ]
                                     });

                                   // Replace checkboxes when they appear
                                   var $state = $("#example-2 thead input[type='checkbox']");

                                   $("#example-2").on('draw.dt', function()
                                                      {
                                                      cbr_replace();

                                                      $state.trigger('change');
                                                      });

                                   // Script to select all checkboxes
                                   $state.on('change', function(ev)
                                             {
                                             var $chcks = $("#example-2 tbody input[type='checkbox']");

                                             if($state.is(':checked'))
                                             {
                                             $chcks.prop('checked', true).trigger('change');
                                             }
                                             else
                                             {
                                             $chcks.prop('checked', false).trigger('change');
                                             }
                                             });
                                   });
                                </script>

                            <table class="table table-bordered table-striped" id="example-2">
                                <thead>
                                    <tr>
                                        <th class="no-sorting">
                                            <input type="checkbox" class="cbr">
                                        </th>
                                        <th>ID</th>
                                        <th>公众号</th>
                                        <th>微信号</th>
                                        <th>账号类型</th>
                                        <th>Token</th>
                                        <th>添加时间</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>

                                <tbody class="middle-align">
                                    @foreach($wechats as $wechat)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="cbr">
                                        </td>
                                        <td>{{ $wechat->id }}</td>
                                        <td>{{ $wechat->public_name }}</td>
                                        <td>{{ $wechat->wechat_account }}</td>
                                        <td>@if($wechat->wechat_type=='subscribe') 订阅号 @elseif($wechat->wechat_type=='service') 服务号 @endif</td>
                                        <td>{{ $wechat->wechat_token }}</td>
                                        <td>{{ $wechat->created_at }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-black dropdown-toggle" data-toggle="dropdown">
                                                    操作 <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-black" role="menu">
                                                    <li>
                                                        <a href="{{route('admin.public.edit',$wechat->id)}}">编辑</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('admin.public.destroy',$wechat->id)}}">删除</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li>
                                                        <a href="#">其他</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            {!!$wechats->render()!!}
                        </div>

					</div>

					<!-- Mailbox Sidebar -->
					<div class="col-sm-3 mailbox-left">

						<div class="mailbox-sidebar">

							<a href="{{route('ucenter.wechat.create')}}" class="btn btn-block btn-secondary btn-icon btn-icon-standalone btn-icon-standalone-right">
								<i class="fa-plus"></i>
								<span>添加公众号</span>
							</a>


							<ul class="list-unstyled mailbox-list">
							    <li class="active">
                                    <a href="#">
                                        公众号
                                        <span class="badge badge-success pull-right">1</span>
                                    </a>
                                </li>
								<li>
									<a href="#">
										关键词管理
										<span class="badge badge-success pull-right">1</span>
									</a>
								</li>
								<li>
									<a href="#">
										自动回复
									</a>
								</li>
								<li>
									<a href="#">
										Drafts
									</a>
								</li>
								<li>
									<a href="#">
										Spam
										<span class="badge badge-purple pull-right">2</span>
									</a>
								</li>
								<li>
									<a href="#">
										Trash
									</a>
								</li>
							</ul>

							<div class="vspacer"></div>

							<ul class="list-unstyled mailbox-list">
								<li class="list-header">Filter by tags</li>
								<li>
									<a href="#">
										ThemeForest
										<span class="badge badge-success badge-roundless pull-right upper">Envato</span>
									</a>
								</li>
								<li>
									<a href="#">
										Society
										<span class="badge badge-red badge-roundless pull-right upper">Friends</span>
									</a>
								</li>
								<li>
									<a href="#">
										Work
										<span class="badge badge-warning badge-roundless pull-right upper">Google</span>
									</a>
								</li>
							</ul>

						</div>

					</div>

				</div>

			</section>
@stop

@section('style')
    {!! Html::style('style/assets/js/datatables/dataTables.bootstrap.css') !!}
@stop
@section('script')
    {!! Html::script('style/assets/js/datatables/js/jquery.dataTables.min.js') !!}
    {!! Html::script('style/assets/js/datatables/dataTables.bootstrap.js') !!}
    {!! Html::script('style/assets/js/datatables/yadcf/jquery.dataTables.yadcf.js') !!}
    {!! Html::script('style/assets/js/datatables/tabletools/dataTables.tableTools.min.js') !!}
@stop