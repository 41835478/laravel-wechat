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
        if($this->packet_type=="GROUP"){
            return [
                'packet_type'   => 'required',
                'total_amount'  => 'required|numeric|min:300|max:100000',
                'total_num'     => 'required|numeric|min:3|max:20',
                'wishing'       => 'required',
                'act_name'      => 'required',
                'remark'        => 'required'
            ];
        }elseif($this->packet_type=="NORMAL"){
            return [
                'packet_type'   => 'required',
                'total_amount'  => 'required|numeric|min:100|max:20000',
                'total_num'     => 'required|numeric|size:1',
                'wishing'       => 'required',
                'act_name'      => 'required',
                'remark'        => 'required'

            ];
        }else{
            return [
                'packet_type'   => 'required'
            ];
        }


    }
}
