@extends('layouts.admin.admin')
@section('content')

@section('flash-message')
    @if (Session::has('flash_notification.message'))
        <div class="alert alert-{{ Session::get('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

            {{ Session::get('flash_notification.message') }}
        </div>
    @endif
@stop
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <a class="btn btn-primary" href="{{ route('admin.wechat-staff.create') }}">添加客服</a>
        </div>
    </div>
</div>
<!-- Removing search and results count filter -->
<div class="panel panel-default">

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
                        null,
                        null,
                        null
                    ],
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
                <th>客服帐号</th>
                <th>客服昵称</th>
                <th>客服编号</th>
                <th>客服头像</th>
                <th>微信号</th>
                <th>邀请微信号</th>
                <th>邀请过期时间</th>
                <th>邀请状态</th>
                <th>操作</th>
            </tr>
            </thead>

            <tbody class="middle-align">

            @foreach($staffs->kf_list as $item)
                <tr>
                    <td>
                        <input type="checkbox" class="cbr">
                    </td>
                    <?php $account = explode('@',$item['kf_account']);
                    ?>
                    <th>{{ $account[0] }}</th>
                    <td>{{ $item['kf_nick'] }}</td>
                    <td>{{ $item['kf_id'] }}</td>
                    <td><img src="{{ $item['kf_headimgurl'] }}" width="50" /> </td>
                    <td>@if(isset($item['kf_wx'])){{ $item['kf_wx'] }}@endif</td>
                    <td>@if(isset($item['invite_wx'])){{ $item['invite_wx'] }}@endif</td>
                    <td>@if(isset($item['invite_expire_time'])){{ date('Y-m-d H:i:s',$item['invite_expire_time']) }}@endif</td>
                    <td>@if(isset($item['invite_status'])){{ $item['invite_status'] }}@endif</td>
                    <td>

                        <a href="{{route('admin.wechat-staff.edit',$item['kf_id'])}}" class="btn btn-secondary btn-sm btn-icon icon-left">
                            编辑
                        </a>

                        @if(!isset($item['kf_wx']) && !isset($item['invite_wx']))
                        <a href="javascript:;" data-account="{{ $item['kf_account'] }}" class="btn btn-danger btn-sm btn-icon icon-left invite">
                            邀请
                        </a>
                        @endif
                        <a href="javascript:;" data-account="{{ $item['kf_account'] }}" class="btn btn-secondary btn-sm btn-icon icon-left upload">
                            头像
                        </a>
                        {!! Form::open(['route'=>['admin.wechat-staff.destroy',$item['kf_account']],'role'=>'form','class'=>'form-horizontal','method'=>'delete','style'=>'display:inline']) !!}
                        <button class="btn btn-danger btn-sm btn-icon icon-left">删除</button>
                        {!! Form::close() !!}
                        {{--
                        <a href="{{route('admin.wechat-menu.sub-menu',$item['kf_id'])}}" class="btn btn-danger btn-sm btn-icon icon-left">
                           客服记录
                        </a>
                        --}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop

@section('other')
    <script type="text/javascript">
        $('.invite').click(function(){
            var obj = $(this);
            showAjaxModal(obj);
        });
        function showAjaxModal(obj)
        {
            jQuery('#modal-7').modal('show');
            var kf_account = obj.data('account') || '';

            var data = {kf_account:kf_account};
            jQuery.ajax({
                url: "{{route('admin.wechat-staff.invite-create')}}",
                data:data,
                type:'post',
                success: function(response)
                {
                    jQuery('#modal-7 .modal-body').html(response);
                },
                async:false
            });
        }

    </script>
    <!-- Modal 7 (Ajax Modal)-->
    <div class="modal fade" id="modal-7">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">邀请绑定客服账号</h4>
                </div>

                <div class="modal-body">

                    Content is loading...

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-info save">邀请</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.save').click(function(){
            //var rule = $('#modal-7 input[name=rule_name]').val();
            var data = $('#modal-7 form').serialize();
            $.ajax({
                url:"{{ route('admin.wechat-staff.invite-store') }}",
                type:'post',
                data:data,
                success: function(response)
                {
                    if (response.status==200){
                        console.log(response.mgs);
                        jQuery('#modal-7').modal('hide');
                        location.reload();
                    }
                },
                dataType:'json'
            });
        });
    </script>

    @include('upload.single',['type'=>'avatar'])
@stop
@section('style')
    {!! Html::style('style/assets/js/datatables/dataTables.bootstrap.css') !!}
    {!! Html::style('style/assets/js/dropzone/css/dropzone.css') !!}
@stop
@section('script')
    {!! Html::script('style/assets/js/datatables/js/jquery.dataTables.min.js') !!}
    {!! Html::script('style/assets/js/datatables/dataTables.bootstrap.js') !!}
    {!! Html::script('style/assets/js/datatables/yadcf/jquery.dataTables.yadcf.js') !!}
    {!! Html::script('style/assets/js/datatables/tabletools/dataTables.tableTools.min.js') !!}
    {!! Html::script('style/assets/js/dropzone/dropzone.min.js') !!}
    <script>

        var kf_account = '';
        $('.upload').click(function(){
            var obj = $(this);
            showAvatarModal(obj);
        });
        function showAvatarModal(obj)
        {
            jQuery('#upload').modal('show');
            kf_account = obj.data('account') || '';
            $('input[name=kf_account]').val(kf_account);
            //alert($('input[name=kf_account]').val());
        }

        // Get the template HTML and remove it from the doument
        var previewNode = document.querySelector("#template");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);

        var myDropzone = new Dropzone('#uploadForm', { // Make the whole body a dropzone
            //paramName:'file',
            url: "{{ route('admin.wechat-staff.upload') }}", // Set the url
            maxFiles:1,
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
        });

        myDropzone.on("addedfile", function(file) {
            // Hookup the start button
            file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
        });

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function(progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
        });

        myDropzone.on("sending", function(file) {
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1";
            // And disable the start button
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
        });
        myDropzone.on("success", function(file) {
            var data = eval('(' + file.xhr.responseText + ')');
            alert(data.msg);

        });
        myDropzone.on("error", function(file) {
            var res = eval('(' + file.xhr.responseText + ')');
            //显示错误信息
            document.querySelector("#error").innerHTML = res.file[0];
        });

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function(progress) {
            document.querySelector("#total-progress").style.opacity = "0";
        });

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions .start").onclick = function() {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
        };
        document.querySelector("#actions .cancel").onclick = function() {
            myDropzone.removeAllFiles(true);
        };
    </script>
@stop