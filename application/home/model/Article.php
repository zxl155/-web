<?php
namespace app\home\model;

use think\Db;
use think\Model;

/**
 *
 * Class Space
 * @package app\common\model
 */
class Article extends Model
{
    /**
     *  查询文章列表
     * @time 2019-06-15
     * @param $colimuId  栏目ID
     * @param $field  查询字段
     * @param $count  显示数量
     * @return $reslut
     */
    public static function ArticleList($colimuId,$field = 'id,name',$count = 4)
    {
        $result = Db::query("SELECT $field FROM duyan_people_article WHERE colimu_id = $colimuId AND `status` = 1 ORDER BY id DESC limit 0,$count" );

        return $result;
    }

    /**
     * 张晓龙
     * @time 2019-06-15
     * @param $colimuId 列表ID
     * @param $count 每页显示条数
     * @param $maxId 下一页
     * @param $minId 上一页
     * @return $result
     */
    public static function detailsList($colimuId,$count,$maxId,$minId)
    {
        $result = Db::table('duyan_people_article')->where('colimu_id','=',$colimuId)->field(['id','name'])->paginate($count);
        $result = Db::query("SELECT id,name FROM duyan_people_article WHERE colimu_id = $colimuId AND `status` = 1 ORDER BY id DESC limit 0,$count" );

        return $result;
    }
}