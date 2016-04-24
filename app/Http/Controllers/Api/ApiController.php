<?php

namespace App\Http\Controllers\Api;

use App\Integral;
use App\OldUser;
use App\OrderDrive;
use App\OrderUpKeep;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    //签到
    /*
     * @param $i_us_id
     * */
    public function makeSign(Request $request)
    {
        $i_us_id = $request->input('i_us_id');
        $isSign  = Integral::where('i_us_id',$i_us_id)
                            ->whereRaw("date_format(i_date,'%Y-%m-%d')=date_format(now(),'%Y-%m-%d')")->first();

        //验证
        //todo

        if($isSign){
            $result = [
                'status'    => 201,
                'msg'       => '今日已签到!'
            ];
        }else{
            $create = Integral::create([
                'i_us_id'  => $i_us_id,
                'i_name'   => '今日签到',
                'i_date'   => date('Y-m-d H:i:s',time())
            ]);

            if($create){
                //用户加分
                $user = OldUser::find($i_us_id);
                $user->us_integral +=1;
                $user->save();
                dd($user);
                $result = [
                    'status'    => 200,
                    'msg'       => '签到成功!',
                    'is_sign'   => 1,
                    'us_integral'=> $user->us_integral
                ];
            }else{
                $result = [
                    'status'    => 201,
                    'msg'       => '网络错误!'
                ];
            }
        }
        return response()->json($result);
    }

    //收藏
    public function makeCollect(Request $request)
    {
        $c_us_id    = $request->input('c_us_id');
        $c_img      = $request->input('c_img');
        $c_title    = $request->input('c_title');
        $c_content  = $request->input('c_content');
        $c_url      = $request->input('c_url');
        $isSign     = Integral::where('c_us_id',$c_us_id)->where('c_url',$c_url)->first();

        //验证
        //todo
        //验证验证码
        $rules = [
            'c_us_id'  => 'required',
            'c_img'    => 'required',
            'c_title'   => 'required',
            'c_content'  => 'required',
            'c_url'    => 'required',
        ];
        $message = [
            'us_carno.required'           => '用户ID错误',
            'us_tel.required'             => '图片地址错误',
            'c_title.required'            => '收藏标题错误',
            'c_content.required'          => '收藏内容错误',
            'c_url.required'              => '收藏链接错误',
        ];
        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            $result = [
                'status'    => 201,
                'msg'       => $validator->errors()->first()
            ];
            return response()->json($result);
        }
        if($isSign){
            $result = [
                'status'    => 201,
                'msg'       => '已收藏!'
            ];
        }else{
            $create = Integral::create([
                'i_us_id'   => $c_us_id,
                'c_img'     => $c_img,
                'c_title'   => $c_title,
                'c_content' => $c_content,
                'c_url'     => $c_url,
                'c_date'    => date('Y-m-d H:i:s',time())
            ]);
            if($create){
                $result = [
                    'status'    => 200,
                    'msg'       => '收藏成功!'
                ];
            }else{
                $result = [
                    'status'    => 201,
                    'msg'       => '网络错误!'
                ];
            }
        }
        return response()->json($result);
    }

    //个人信息
    public function userStore(Request $request)
    {
        $us_id       = $request->input('us_id');
        $us_name     = $request->input('us_name');
        $us_gender   = $request->input('us_gender');
        $us_tel      = $request->input('us_tel');
        $us_address  = $request->input('us_address');

        //验证
        //todo
        $rules = [
            'us_id'         => 'required',
            'us_name'       => 'required',
            'us_gender'     => 'required',
            'us_tel'        => 'required',
            'us_address'    => 'required',
        ];
        $message = [
            'us_id.required'              => '用户ID错误',
            'us_name.required'            => '请填写您的姓名',
            'us_gender.required'          => '请选择您的性别',
            'us_tel.required'             => '请填写手机号',
            'us_address.required'         => '请填您的地址',
        ];
        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            $result = [
                'status'    => 201,
                'msg'       => $validator->errors()->first()
            ];
            return response()->json($result);
        }
        $data = [
            "us_name"   => $us_name,
            "us_gender" => $us_gender,
            "us_tel"    => $us_tel,
            "us_address"=> $us_address,
        ];
        $update = OldUser::where('us_id',$us_id)->update($data);
        if($update){
            $result = [
                'status'    => 200,
                'msg'       => '保存成功!'
            ];
        }else{
            $result = [
                'status'    => 201,
                'msg'       => '网络错误!'
            ];
        }
        return response()->json($result);
    }

    //车辆绑定
    public function makeCarBind(Request $request)
    {
        $us_id      = $request->input('us_id');
        $us_carno   = $request->input('us_carno');
        $us_tel     = $request->input('us_tel');
        $captcha    = $request->input('captcha');
        //验证验证码
        $rules = [
            'us_carno'  => 'required',
            'us_tel'    => 'required',
            'captcha'   => 'required|captcha'
        ];
        $message = [
            'us_carno.required'           => '请填写车架号',
            'us_tel.required'             => '请填写手机号',
            'captcha'                     => '验证码错误'
        ];
        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            $result = [
                'status'    => 201,
                'msg'       => $validator->errors()->first()
            ];
            return response()->json($result);
        }

        $data = [
            'us_carno'  => $us_carno,
            'us_tel'    => $us_tel
        ];
        $update = OldUser::where('us_id',$us_id)->update($data);
        if($update){
            $result = [
                'status'    => 200,
                'msg'       => '保存成功!'
            ];
        }else{
            $result = [
                'status'    => 201,
                'msg'       => '网络错误!'
            ];
        }
        return response()->json($result);

    }

    //违章查询
    public function getViolation(Request $request)
    {
        //

        //验证
        //todo

    }

    public function getOilRecord(Request $request)
    {
        //验证
        //todo
    }


    //预约试驾

    public function appointTestDrive(Request $request)
    {
        $data = $request->only(['od_us_id','od_st_id','od_s_id','od_ct_id','od_name','od_tel','od_km','od_msg']);
        $rules = [
            'od_us_id'          => 'required',
            'od_st_id'          => 'required',
            'od_s_id'           => 'required',
            'od_ct_id'          => 'required',
            'od_name'           => 'required',
            'od_tel'            => 'required',
            'od_msg'            => 'required'
        ];
        $message = [
            'ou_us_id.required'           => '请填写用户ID',
            'ou_st_id.required'           => '请选择4S店',
            'od_s_id.required'            => '请选择车系',
            'od_ct_id.required'           => '请选择车型',
            'od_name.required'            => '请填写您的姓名',
            'od_tel.required'             => '请填写您的手机号',
            'od_msg.required'             => '请填写留言信息',
        ];

        $validator = Validator::make($data,$rules,$message);
        if($validator->fails()){
            $result = [
                'status'    => 201,
                'msg'       => $validator->errors()->first()
            ];
        }else{
            $create = OrderDrive::create($data);
            if($create){
                $result = [
                    'status'    => 200,
                    'msg'       => '预约成功'
                ];
            }else{
                $result = [
                    'status'    => 201,
                    'msg'       => '网络错误'
                ];
            }
        }
        return response()->json($result);
    }
    //预约维修/保养


    public function appointMaintenance(Request $request)
    {
        $data = $request->only(['ou_us_id','ou_st_id','ou_type','ou_carno','ou_name','ou_tel','ou_km','ou_msg']);
        $rules = [
            'ou_us_id'          => 'required',
            'ou_st_id'          => 'required',
            'ou_type'           => 'required',
            'ou_carno'          => 'required',
            'ou_name'           => 'required',
            'ou_tel'            => 'required',
            'ou_msg'            => 'required'
        ];
        $message = [
            'ou_us_id.required'           => '请填写用户ID',
            'ou_st_id.required'           => '请选择4s店',
            'ou_type.required'            => '请选择预约类型',
            'ou_carno.required'           => '请填写车架号',
            'ou_name.required'            => '请填写您的姓名',
            'ou_tel.required'             => '请填写您的手机号',
            'ou_msg.required'             => '请填写留言信息',
        ];

        $validator = Validator::make($data,$rules,$message);
        if($validator->fails()){
            $result = [
                'status'    => 201,
                'msg'       => $validator->errors()->first()
            ];
        }else{
            $create = OrderUpKeep::create($data);
            if($create){
                $result = [
                    'status'    => 200,
                    'msg'       => '预约成功'
                ];
            }else{
                $result = [
                    'status'    => 201,
                    'msg'       => '网络错误'
                ];
            }
        }
        return response()->json($result);
    }
}
