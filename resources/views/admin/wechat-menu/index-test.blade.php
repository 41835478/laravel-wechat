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
<div class="notes-env">

    <div class="notes-header">
        <a class="btn btn-secondary btn-icon btn-icon-standalone" id="add-note">
            <i class="fa-plus"></i>
            <span>新菜单</span>
        </a>
    </div>


    <div class="notes-list">

        <ul class="list-of-notes">

            <!-- predefined notes -->
            <li class="current"> <!-- class "current" will set as current note on Write Pad -->
                <a href="#">
                    <strong>This is sample note</strong>
                    <span>How are you buddy?</span>
                </a>

                <button class="note-close">&times;</button>

                <div class="content">This is sample note
                    How are you buddy?
                </div>
            </li>

            <li>
                <a href="#">
                    <strong>New Note</strong>
                    <span>Remember to take the bus and leave at 04:00 PM</span>
                </a>

                <button class="note-close">&times;</button>

                <div class="content">New Note
                    Remember to take the bus and leave at 04:00 PM

                    Another line of text...</div>
            </li>

            <li>
                <a href="#">
                    <strong>Dream Chasers</strong>
                    <span>Case read they must it of cold that.</span>
                </a>

                <button class="note-close">&times;</button>

                <div class="content">Dream Chasers
                    Case read they must it of cold that.

                    Speaking trifling an to unpacked moderate debating learning. An particular contrasted he excellence favourable on. Nay preference dispatched difficulty continuing joy one. Songs it be if ought hoped of. Too carriage attended him entrance desirous the saw. Twenty sister hearts garden limits put gay has. We hill lady will both sang room by. Desirous men exercise overcame procured speaking her followed.
                </div>
            </li>

            <!-- this will be automatically hidden when there are notes in the list -->
            <li class="no-notes">
                There are no notes yet!
            </li>
        </ul>


        <div class="write-pad">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Default form inputs</h3>
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

                    <form role="form" class="form-horizontal">

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="field-1">Input text field</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="field-1" placeholder="Placeholder">
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="field-2">Password</label>

                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="field-2" placeholder="Placeholder (Password)">
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Disabled input</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Placeholder" disabled>
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="field-3">Email field</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="field-3" placeholder="Enter your email&hellip;">
                                <p class="help-block">Example block-level help text here. Emails inputs are validated on native HTML5 forms.</p>
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="field-4">File Field</label>

                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="field-4">
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="field-5">Text area</label>

                            <div class="col-sm-10">
                                <textarea class="form-control" cols="5" id="field-5"></textarea>
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="field-5">Auto grow</label>

                            <div class="col-sm-10">
                                <textarea class="form-control autogrow" cols="5" id="field-5" placeholder="I will grow as you enter new lines."></textarea>
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group has-error">
                            <label class="col-sm-2 control-label" for="field-6">Error field</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="field-6" placeholder="Hello I am an error">
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group has-warning">
                            <label class="col-sm-2 control-label" for="field-7">Warning field</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="field-7" placeholder="Hello I am a warning">
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group has-success">
                            <label class="col-sm-2 control-label" for="field-8">Success field</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="field-8" placeholder="Hello I am a success message">
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group has-info">
                            <label class="col-sm-2 control-label" for="field-9">Info field</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="field-9" placeholder="Hello I am an info message">
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="field-11">Input size</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control input-sm" id="field-13" placeholder=".input-sm">
                                <br />
                                <input type="text" class="form-control" id="field-14" placeholder="Normal input">
                                <br />
                                <input type="text" class="form-control input-lg" id="field-15" placeholder=".input-lg">
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="field-11">Input text position</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control text-center" id="field-11" placeholder="Placeholder">
                                <br />
                                <input type="text" class="form-control text-right" id="field-12" placeholder="Placeholder">
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Select list</label>

                            <div class="col-sm-10">
                                <select class="form-control">
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                    <option>Option 4</option>
                                    <option>Option 5</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Checkboxes</label>

                            <div class="col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">
                                        Default checkbox
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">
                                        Another one
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" disabled>
                                        Disabled option
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" checked disabled>
                                        Checked and disabled option
                                    </label>
                                </div>

                                <br />
                                <strong>Inline checkboxes</strong>

                                <p>
                                    <label class="checkbox-inline">
                                        <input type="checkbox">
                                        Inline checkbox 1
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox">
                                        Inline checkbox 2
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox">
                                        Inline checkbox 3
                                    </label>
                                </p>

                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Radio buttons</label>

                            <div class="col-sm-10">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="radio-1" checked>
                                        Default radio
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="radio-1">
                                        Another one
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" disabled>
                                        Disabled option
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" checked disabled>
                                        Checked and disabled option
                                    </label>
                                </div>

                                <br />
                                <strong>Inline radio buttons</strong>

                                <p>
                                    <label class="radio-inline">
                                        <input type="radio" name="radio-2" checked>
                                        Inline radio button 1
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="radio-2">
                                        Inline radio button 2
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="radio-2">
                                        Inline radio button 3
                                    </label>
                                </p>

                            </div>
                        </div>


                    </form>

                </div>
            </div>

        </div>

    </div>
</div>
@stop
@section('other')
    <script type="text/javascript">
        $('.add-menu').click(function(){
            var obj = $(this);
            addMenu(obj);
        });
        function addMenu(obj)
        {
            var html = '这是菜单编辑';
            obj.parent().next().append(html);
        }
    </script>
    <!-- Modal 7 (Ajax Modal)-->
    <div class="modal fade" id="modal-7">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">关键词规则</h4>
                </div>

                <div class="modal-body">

                    Content is loading...

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-info save">保存</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.save').click(function(){
            //var rule = $('#modal-7 input[name=rule_name]').val();
            var data = $('#modal-7 form').serialize();
            $.ajax({
                url:"{{ route('admin.wechat-reply.rule-store') }}",
                type:'post',
                data:data,
                success: function(response)
                {
                    if (response.status==200){
                        console.log(response.mgs);
                        jQuery('#modal-7').modal('hide');
                    }
                },
                dataType:'json'
            });
        });
    </script>
@stop
@section('style')
    {!! Html::style('style/assets/js/datatables/dataTables.bootstrap.css') !!}
@stop
@section('script')
    {!! Html::script('style/assets/js/datatables/js/jquery.dataTables.min.js') !!}
    {!! Html::script('style/assets/js/datatables/dataTables.bootstrap.js') !!}
    {!! Html::script('style/assets/js/datatables/yadcf/jquery.dataTables.yadcf.js') !!}
    {!! Html::script('style/assets/js/datatables/tabletools/dataTables.tableTools.min.js') !!}
        <!-- Imported scripts on this page -->
    {!! Html::script('style/assets/js/xenon-notes.js') !!}
@stop