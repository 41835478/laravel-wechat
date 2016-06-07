<?php namespace App\Http\Controllers\Admin;
    
    use App\Http\Controllers\Controller;
    use App\User;
    use App\Wechat;
    use Illuminate\Support\Facades\Auth;

    class BaseController extends Controller {

        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public $user;

        public $wechat;

        public function __construct()
        {
            $this->middleware('auth');
            $this->middleware('access');

            //
            $this->user = Auth::user();
            $user_id = 1;
            $this->wechat = Wechat::where('user_id',$user_id)->firstOrFail();
        }
    }