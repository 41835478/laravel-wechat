<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 6/10/15
 * Time: 11:39 AM
 */

namespace App\Http\Controllers\Home;


use App\Award;
use App\Event;
use App\Http\Controllers\Controller;
use App\Join;
use App\Winner;
use Illuminate\Html;
use Illuminate\Http\Request;

class EventController extends Controller{

    public function activity($id)
    {
        $event = Event::find($id);
        $award = Award::where('event_id','=',$id)->firstOrFail();
        return view('home.activity.action',compact('event','award'));
    }


    public function start(Request $request)
    {
        if($request->ajax()){
            //get ip and store info

            $winner = Winner::where('user_id','=',$request->ip())->first();
            if(!empty($winner)){
                $result = [
                    'msg' => '您已经抢过了，不能再抢了哦～',
                    'cdkey' => $winner->cdkey,
                    'status' => '2'
                ];
            }else{
                $join = Join::create([
                    'ip'=>$request->ip()
                ]);
                //get kucun
                if($join->id){
                    $award = Award::find($request->input('event_id'));
                    $result = [
                        'msg' => '恭喜！您抢到了',
                        'cdkey' => $request->input('event_id'),
                        'status' => '1'
                    ];
                    if($award->surplus<=0){
                        $result = [
                            'msg' => '很遗憾,被抢光了！',
                            'status' => '0'
                        ];
                    }else{
                        //库存－1
                        $award->surplus = $award->surplus-1;
                        $award->save();
                        //生成cdkey
                        $cdkey = $this->generateCdkey(5);
                        //
                        //保存中奖用户
                        $winner = Winner::create([
                            'user_id' => $request->ip(),
                            'award_id' => $request->input('award_id'),
                            'cdkey' => $cdkey,
                            'event_id' => $request->input('event_id')
                        ]);
                        $result = [
                            'msg' => '恭喜！您抢到了',
                            'cdkey' => $cdkey,
                            'status' => '1'
                        ];

                    }
                }
            }



        }

        return response()->json($result);
    }


    //生成兑奖码
    public function generateCdkey($len)
    {
        $chars_array = array(
            "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
            "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
            "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
            "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
            "S", "T", "U", "V", "W", "X", "Y", "Z",
        );
        $charsLen = count($chars_array) - 1;

        $outputstr = "";
        for ($i=0; $i<$len; $i++)
        {
            $outputstr .= $chars_array[mt_rand(0, $charsLen)];
        }
        return $outputstr;
    }
}