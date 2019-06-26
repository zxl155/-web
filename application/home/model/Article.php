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
     * @param $isRecommend 是否推荐
     * @return $reslut
     */
    public static function ArticleList($colimuId,$field = 'id,name',$count = 4,$isRecommend = 0)
    {
        if ($isRecommend == 1) {
            $result = Db::query("SELECT $field FROM duyan_people_article WHERE `status` = 1 AND `name` <> '' AND `content` <> '' and picture_url = '' ORDER BY id DESC limit 0,$count" );

        } else {
            $result = Db::query("SELECT $field FROM duyan_people_article WHERE colimu_id = $colimuId AND `status` = 1 ORDER BY id DESC limit 0,$count" );
        }


        return $result;
    }

    /**
     * 张晓龙
     * @time 2019-06-15
     * @param $colimuId 列表ID
     * @param $pageSize 每页显示条数
     * @param $pages 当前页
     * @param $field 字段
     * @return $result
     */
    public static function detailsList($colimuId,$pages,$pageSize,$field = 'id,name')
    {
        $pageStart = ($pages - 1) * $pageSize;

        $result = Db::query("SELECT $field FROM duyan_people_article WHERE colimu_id = $colimuId AND `status` = 1 ORDER BY id DESC limit $pageStart,$pageSize" );
        $count  = Db::table('duyan_people_article')->where(array('status' => 1,'colimu_id' => $colimuId))->count();
        $countPage = ceil($count/$pageSize);

        $data = array('countPage' => $countPage,'result' => $result);
        return $data;
    }
    /**
     * 张晓龙
     * @time 2019-06-17
     * @param $articleId 内容ID
     * @param $field 字段
     * @return $result
     */
    public static function contentDetails($articleId,$field = 'id,name,content')
    {
        $result = Db::query("SELECT $field FROM duyan_people_article WHERE id = $articleId");

        return $result;
    }
    /**
     * 张晓龙
     * 获取当前数据的上一条跟下一条
     * @time 2019-06-17
     * @param $colimuId 栏目ID
     * @return $result
     */
    public static function aroundList($articleId,$colimuId)
    {
        $result = Db::query("SELECT id,name FROM duyan_people_article WHERE colimu_id = $colimuId AND id IN((SELECT MAX(id) FROM duyan_people_article WHERE id< $articleId), (SELECT MIN(id) FROM duyan_people_article WHERE id> $articleId)) ");

        return $result;
    }
    /**
     * 张晓龙
     * 添加报名信息
     * @time 2019-06-26
     * @param $data 数据
     */
    public static function addSignUp($data)
    {
        $datas = array('name' => $data['xingming'],
            'dianhua' => $data['shouji'],
            'yxzy' => $data['yxzy'],
            'szdq' => $data['diqu'],
            'time' => date("Y-m-d H:i:s")
        );

        $result = Db('duyan_form_baoming')->insert($datas);

        return $result;
    }

}