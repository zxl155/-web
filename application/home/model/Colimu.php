<?php
namespace app\home\model;

use think\Db;
use think\Model;

/**
 *
 * Class Space
 * @package app\common\model
 */
class Colimu extends Model
{
    /**
     *  首页导航栏
     * @time 2019-06-15
     * @param
     * @return $reslut
     */
    public static function colimuList()
    {
        $result = Db::query("SELECT id,name,column_url FROM duyan_people_colimu WHERE `status` = 1 AND is_navigation = 1");

        return $result;
    }
    /**
     *  单条信息查询
     * @time 2019-06-15
     * @param $id 导航ID
     * @return $reslut
     */
    public static function oneList($id)
    {
        $result = Db::query("SELECT id,name,type,column_url FROM duyan_people_colimu WHERE `id` = $id");

        return $result;
    }
}