<?php namespace App\Http\Controllers\Admin;
    
    use App\Http\Controllers\Controller;
    use App\User;
    use Illuminate\Support\Facades\Auth;

    class BaseController extends Controller {

        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public $user;

        public function __construct()
        {
            $this->middleware('auth');
            $this->middleware('access');

            //
            $this->user = Auth::user();
        }
    }