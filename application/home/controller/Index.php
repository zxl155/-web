<?php
namespace app\home\controller;

class Index extends \think\Controller
{
    /**
     * 首页展示
     * @param
     * @return
     */
    public function indexShow()
    {

        return $this->fetch('index');
    }

}
