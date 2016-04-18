<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 9/1/15
 * Time: 1:46 PM
 */
 ?>

@section('others')
	<div class="modal fade" id="upload">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">上传图片</h4>
				</div>

				<div class="modal-body">
				{!! Form::open(['route'=>['upload'],'role'=>'form','id'=>'uploadForm','enctype'=>'multipart/form-data']) !!}
                    {!! Form::hidden('type',$type) !!}
                {!! Form::close() !!}
                    <div id="actions" class="row">
                      <div class="col-lg-7">
                        <!-- The fileinput-button span is used to style the file input field as button -->
                        <span class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>添加图片</span>
                        </span>
                        <button type="submit" class="btn btn-primary start">
                            <i class="glyphicon glyphicon-upload"></i>
                            <span>开始上传</span>
                        </button>
                        <button type="reset" class="btn btn-warning cancel">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>取消上传</span>
                        </button>
                      </div>

                      <div class="col-lg-5">
                        <!-- The global file processing state -->
                        <span class="fileupload-process">
                          <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                          </div>
                        </span>
                      </div>

                    </div>
                        <div class="table table-striped" class="files" id="previews">

                          <div id="template" class="file-row">
                            <!-- This is used as the file preview template -->
                            <div>
                                <span class="preview"><img data-dz-thumbnail /></span>
                            </div>
                            <div>
                                <p class="name" data-dz-name></p>
                                <strong class="error text-danger" id="error" data-dz-errormessage></strong>
                            </div>
                            <div>
                                <p class="size" data-dz-size></p>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                  <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                </div>
                            </div>
                            <div>
                              <button class="btn btn-primary start">
                                  <i class="glyphicon glyphicon-upload"></i>
                                  <span>上传</span>
                              </button>
                              <button data-dz-remove class="btn btn-warning cancel">
                                  <i class="glyphicon glyphicon-ban-circle"></i>
                                  <span>取消</span>
                              </button>
                              <button data-dz-remove class="btn btn-danger delete">
                                <i class="glyphicon glyphicon-trash"></i>
                                <span>删除</span>
                              </button>
                            </div>
                          </div>

                        </div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
				</div>
			</div>
		</div>
	</div>
@stop

@section('css')
    {!! Html::style('assets/js/dropzone/css/dropzone.css') !!}
@stop

@section('scripts')
    {!! Html::script('assets/js/dropzone/dropzone.min.js') !!}
    <script>
      // Get the template HTML and remove it from the doument
      var previewNode = document.querySelector("#template");
      previewNode.id = "";
      var previewTemplate = previewNode.parentNode.innerHTML;
      previewNode.parentNode.removeChild(previewNode);

      var myDropzone = new Dropzone('#uploadForm', { // Make the whole body a dropzone
        //paramName:'file',
        url: "{{ route('upload') }}", // Set the url
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
        $('#pic_url').val(data.path);
        $('#preview_pic').html('<img src="'+ "{{url('')}}/" + data.path +'" width="80">');

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