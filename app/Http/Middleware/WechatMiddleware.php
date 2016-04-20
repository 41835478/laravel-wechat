<?php

namespace App\Http\Middleware;

use Closure;

class WechatMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * @desc   微信授权中间件
     */
    public function handle($request, Closure $next)
    {
        //
        if($request->session()->get('wechat_id', '0')==$request->input('wechatId') && $request->session()->get('wechat_user', '')!=''){
            //跳转到业务页
            return $next($request);

        }else{
            $request->session()->put('target_url',$request->url());
            return redirect()->route('wechat.auth');
        }


    }
}
