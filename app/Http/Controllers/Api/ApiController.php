<?php

namespace App\Http\Controllers\Api;

use App\CarModel;
use App\Integral;
use App\OilWear;
use App\OldUser;
use App\OrderDrive;
use App\OrderUpKeep;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    private $appkey = 'a0142bc6b9dfd552f9308aa94be1fb15';

    private $cityUrl = 'http://v.juhe.cn/wz/citys';

    private $wzUrl = 'http://v.juhe.cn/wz/query';
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
            'us_date'   => date('Y-m-d H:i:s',time())
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
        //验证
        //todo
        $city = $request->input('city');       //城市代码
        $carno = $request->input('carno');   //车牌号
        $engineno = $request->input('engineno');  //发动机号
        $classno = $request->input('classno');    //车架号
        $wzResult = $this->query($city,$carno,$engineno,$classno);
        return response()->json($wzResult);
    }

    //油耗计算接口
    public function oilConsumption(Request $request)
    {
        $us_id      = $request->input('us_id');
        $journey    = $request->input('journey');   //总里程
        $fuel       = $request->input('fuel');      //总油量
        $price      = $request->input('price');     //油价
        //验证验证码
        $rules = [
            'us_id'    => 'required',
            'journey'  => 'required|numeric',
            'fuel'     => 'required|numeric',
            'price'    => 'required|numeric'
        ];
        $message = [
            'journey.required'          => '请填写车架号',
            'us_carno.numeric'          => '请填写正确的数值',
            'fuel.required'             => '请填写手机号',
            'fuel.numeric'              => '请填写正确的数值',
            'price.required'            => '请填写价格',
            'price.numeric'             => '请填写正确的数值',
        ];
        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            $result = [
                'status'    => 201,
                'msg'       => $validator->errors()->first()
            ];
            return response()->json($result);
        }
        //油耗计算
        $onekm  = $journey/$fuel;  //每公升油可以行驶
        $oneoil = $fuel/$journey;  //每公里油耗
        $kmmoney= $oneoil*$price;  //每公里的油钱
        $create = OilWear::create([
            'o_us_id'     => $us_id,
            'o_oneoil'    => number_format($oneoil,3),
            'o_onekm'     => number_format($onekm,3),
            'o_kmmoney'   => number_format($kmmoney,3),
            '0_date'   => date('Y-m-d H:i:s',time())
        ]);
        if($create){
            $result = [
                'status'    => 200,
                'msg'       => '计算成功!',
                'info'      => $create
            ];
        }else{
            $result = [
                'status'    => 201,
                'msg'       => '网络错误!'
            ];
        }
        return response()->json($result);
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
        $data['od_date'] = date('Y-m-d H:i:s',time());
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
        $data['ou_date'] = date('Y-m-d H:i:s',time());
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

    //获取chex
    public function getCarModels(Request $request)
    {
        $s_id = $request->input('s_id');
        if($s_id){
            $carmodels = CarModel::where('s_id',$s_id)->get();
            $result = [
                'status'    => 200,
                'msg'       => '获取成功',
                'models'    => $carmodels
            ];
        }else{
            $result = [
                'status'    => 201,
                'msg'       => '网络错误'
            ];
        }
        return response()->json($result);
    }

    /**
     * 获取违章支持的城市列表
     * @return array
     */
    public function getCitys($province=false){
        $params = 'key='.$this->appkey."&format=2";
        $content = $this->juhecurl($this->cityUrl,$params);
        return $this->_returnArray($content);
    }
    /**
     * 查询车辆违章
     * @param  string $city     [城市代码]
     * @param  string $carno    [车牌号]
     * @param  string $engineno [发动机号]
     * @param  string $classno  [车架号]
     * @return  array 返回违章信息
     */
    public function query($city,$carno,$engineno='',$classno=''){
        $params = array(
            'key' => $this->appkey,
            'city'  => $city,
            'hphm' => $carno,
            'engineno'=> $engineno,
            'classno'   => $classno
        );
        $content = $this->juhecurl($this->wzUrl,$params,1);
        return $this->_returnArray($content);
    }

    /**
     * 将JSON内容转为数据，并返回
     * @param string $content [内容]
     * @return array
     */
    public function _returnArray($content){
        return json_decode($content,true);
    }

    /**
     * 请求接口返回内容
     * @param  string $url [请求的URL地址]
     * @param  string $params [请求的参数]
     * @param  int $ipost [是否采用POST形式]
     * @return  string
     */
    public function juhecurl($url,$params=false,$ispost=0){
        $httpInfo = array();
        $ch = curl_init();

        curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
        curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
        if( $ispost )
        {
            curl_setopt( $ch , CURLOPT_POST , true );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
            curl_setopt( $ch , CURLOPT_URL , $url );
        }
        else
        {
            if($params){
                curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
            }else{
                curl_setopt( $ch , CURLOPT_URL , $url);
            }
        }
        $response = curl_exec( $ch );
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
        curl_close( $ch );
        return $response;
    }
}
