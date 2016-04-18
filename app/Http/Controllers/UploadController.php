<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 9/1/15
 * Time: 9:05 AM
 */

namespace App\Http\Controllers;


use App\Http\Requests\UploadRequest;
use Illuminate\Support\Facades\File;

class UploadController extends Controller{

    public function upload(UploadRequest $request)
    {
        $type = $request->input('type');
        if($request->ajax()){
            //确认文件是否有上传
            if($request->hasFile('file')){
                //code..
                $file = $request->file('file');
                if(!$file->isValid()){
                    $result = ['status'=>'failed','msg'=>'上传文件无效！'];
                }else{
                    $extension = $file->getClientOriginalExtension();//取得上传文件的后缀名
                    $path = 'uploads/'.$type.'/';
                    $savePath = $path.date('Ymd',time());
                    File::exists($savePath) or File::makeDirectory($savePath,0755,true);

                    $saveFileName = uniqid().'_'.$type.'.'.$extension;//函数基于以微秒计的当前时间，生成一个唯一的 ID。

                    $file->move($savePath,$saveFileName);

                    $fullFileName = $savePath.'/'.$saveFileName;

                    $result = ['status'=>'success','msg'=>'上传成功！','path'=>$fullFileName];
                }

            }else{
                $result = ['status'=>'failed','msg'=>'请选择上传文件！'];
            }
            return $result;
        }

    }
} 