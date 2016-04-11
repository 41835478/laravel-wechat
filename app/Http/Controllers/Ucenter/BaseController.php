<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 6/26/15
 * Time: 11:58 AM
 */

namespace App\Http\Controllers\Ucenter;


use App\Http\Controllers\Controller;

class BaseController extends Controller{
    public function __construct()
    {
        $this->middleware('auth');
    }
} 