<?php

namespace App\Http\Controllers\Api;

use App\Integral;
use App\OldUser;
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

}
