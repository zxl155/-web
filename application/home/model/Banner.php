<?php
namespace app\home\model;

use think\Db;
use think\Model;

/**
 *
 * Class Space
 * @package app\common\model
 */
class Banner extends Model
{
    /**
     *  查询banner图片
     * @time 2019-06-14
     * @return $reslut
     */
    public static function bannerList()
    {
        $result = Db::table('duyan_poster')
            ->where('spaceid','=',479)
            ->order('id','desc')
            ->limit(1)
            ->value('setting');

        return $result;
    }
}