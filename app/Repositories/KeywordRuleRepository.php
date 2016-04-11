<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 7/20/15
 * Time: 2:19 PM
 */

namespace App\Repositories;


use App\KeywordRule;

class KeywordRuleRepository {

    public function create(array $data)
    {
        //return $data;
        return KeywordRule::create([
            'rule_name' => $data['rule_name'],
            'wechat_id' => $data['wechat_id'],
            'match_type' => $data['match_type'],
            'rule_type' => 'keywords',
        ]);
    }

    public function update(array $data,$ruleId)
    {
        $keywordRule = KeywordRule::find($ruleId);
        $keywordRule->rule_name = $data['rule_name'];
        $keywordRule->wechat_id = $data['wechat_id'];
        $keywordRule->match_type = $data['match_type'];
        $keywordRule->rule_type = $data['rule_type'];
        $keywordRule->save();
        return $keywordRule;
    }
} 