<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class WechatRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			"public_name" => "required|alpha_dash|between:2,16|unique:wechats,public_name,".$this->id,
            "original_id" => "required|alpha_dash|size:15",
            "wechat_account" => "required|between:5,16",
            "wechat_type" => "required|digits:1",
            "app_id" => "required|size:18",
            "secret" => "size:32",
            "wechat_token" => "required|between:1,64",
		];
	}

}
