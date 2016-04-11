<?php namespace App\Http\ViewComposers;
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 7/17/15
 * Time: 3:57 PM
 */

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class LeftComposer {

    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $wechatId = Request::route('wechatId');
        if(Request::route('wechat')) {
            $wechatId = Request::route('wechat');
        }
        $view->with('wechatId', $wechatId);
    }

}