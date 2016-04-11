<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 7/21/15
 * Time: 4:52 PM
 */

namespace App\Repositories;


use App\Keyword;

class WechatKeywordRepository {

    public function create(array $data)
    {
        //return $data;
        return Keyword::create([
            'keyword_rule_id' => $data['keyword_rule_id'],
            'keyword' => $data['keyword'],
            'match_type' => $data['match_type']
        ]);
    }

    public function update(array $data)
    {
        $keyword = Keyword::find($data['keyword_id']);
        $keyword->keyword = $data['keyword'];
        $keyword->match_type = $data['match_type'];
        $keyword->save();
        return $keyword;
    }
} 