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
}