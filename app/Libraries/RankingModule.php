<?php
namespace app\Libraries;

use Illuminate\Http\Request;
use Redis;

class RankingModule
{
    //閲覧数をインクリメント
    public function increment_view_ranking($id){
        $key = "ranking-"."id:".$id;

        $value = Redis::get($key);
        if(empty($value)){
            Redis::set($key, "1");
            Redis::expire($key, 3600*24); 
        } else {
            Redis::set($key, $value + 1);
        }
    }

    //ランキング結果を配列で取得
    public function get_ranking_all(){
        $keys = Redis::keys('ranking-*');
        $results = Array();

        if(empty($keys) != true){
            for($i = 0; $i < sizeof($keys); $i++){
                $id = explode(':', $keys[$i])[1];
                $point = Redis::get('ranking-id:'. $id);
                $results[$id] = $point;
            }
            arsort($results, SORT_NUMERIC);
        }
        return $results;
    }
}