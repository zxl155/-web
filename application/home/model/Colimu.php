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
    public static function ColimuList()
    {
        $result = Db::query("SELECT name FROM duyan_people_colimu WHERE `status` = 1 AND is_navigation = 1");

        return $result;
    }
}