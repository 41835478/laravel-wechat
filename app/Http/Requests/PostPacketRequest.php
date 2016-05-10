<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostPacketRequest extends Request
{
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
            'total_amount'  => 'required|numeric|min:300',
            'total_num'     => 'required|numeric|min:3',
            'wishing'       => 'required',
            'act_name'      => 'required',
            'remark'        => 'required'
        ];
    }
}
