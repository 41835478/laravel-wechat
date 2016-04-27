<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 9/1/15
 * Time: 9:05 AM
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Validator;

class UploadController extends Controller{

    public function upload(\Illuminate\Http\Request $request)
    {
        $data = $request->only('file');
        $rules = [
            'file'          => 'required|image',
        ];
        $message = [
            'ou_us_id.required'           => '选择上传图片',
            'ou_st_id.images'             => '请上传图片格式文件,支持jpeg、png、bmp、gif、 或 svg'
        ];
        $validator = Validator::make($data,$rules,$message);
        if($validator->fails()){
            $result = [
                'status'    => 201,
                'msg'       => $validator->errors()->first()
            ];
            return response()->json($result);
        }
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