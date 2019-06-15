<?php
namespace app\home\controller;

use app\home\model\Banner;
use app\home\model\Colimu;
use app\home\model\Article;

class Index extends \think\Controller
{
    /**
     * 首页展示
     * @param
     * @return
     * stripslashes（） 删除反斜杠
     */
    public function indexShow()
    {
        //获取banner
        $bannerResult = Banner::bannerList();
        // banner图片地址
        $bannerPictureUrl = '';
        if (!empty($bannerResult)) {
            $bannerPicture =  json_decode(stripslashes($bannerResult),true);
            $bannerPictureUrl = $bannerPicture[1]['imageurl'];
        }

        //获取导航栏
        $colimuResult = Colimu::ColimuList();
        //获取活动公共
        $activityResult = Article::ArticleList(3,'id,name,content',4);
        /*foreach ($activityResult as $activityKey => $activityValue) {
            $activityResult[$activityKey]['content'] = substr_replace($activityValue['content'],'...',75);
        }*/

        //获取同学新闻
        $classMateResult = Article::ArticleList(4,'id,name,picture_url',$count = 5);
        $classMateNumber = 0;
        foreach ($classMateResult as $classMateKey => $classMateValue) {
            if (!empty($classMateValue['picture_url']) && $classMateNumber < 2) {
                $classMateResult[$classMateKey]['is_url'] = 1;
                ++$classMateNumber;
            } else {
                $classMateResult[$classMateKey]['is_url'] = 0;
            }

        }

        //获取活动图片
        $pictureResult = Article::ArticleList(6,'id,picture_url',3);
        //获取招生信息
        $recruitStudentResult = Article::ArticleList(7,'id,name',5);
        //获取双硕信息
        $sasuResult = Article::ArticleList(8,'id,name',5);
        //获取管理智库信息
        $administrationResult = Article::ArticleList(9,'id,name',5);
        //获取企业内训信息
        $enterpriseResult = Article::ArticleList(10,'id,name',5);

        //获取院校咨询信息
        $collegesResult = Article::ArticleList(1,'id,name,picture_url,create_time',4);
        $collegesNumber = 0;
        foreach ($collegesResult as $collegesKey => $collegesValue) {
            if (!empty($collegesValue['picture_url']) && $collegesNumber < 1) {
                $collegesResult[$collegesKey]['is_url'] = 1;
                ++$collegesNumber;
            } else {
                $collegesResult[$collegesKey]['is_url'] = 0;
            }

        }

        //获取师资介绍
        $teachersResult = Article::ArticleList(5,'id,name,content,picture_url',3);
        //获取课程试听
        $courseAuditionResult = Article::ArticleList(11,'id,name,picture_url,audition_count',3);

        return $this->fetch('index',['bannerPictureUrl' => $bannerPictureUrl,
            'colimuResult' => $colimuResult,
            'activityResult' => $activityResult,
            'classMateResult' => $classMateResult,
            'pictureResult' => $pictureResult,
            'recruitStudentResult' => $recruitStudentResult,
            'sasuResult' => $sasuResult,
            'administrationResult' => $administrationResult,
            'enterpriseResult' => $enterpriseResult,
            'collegesResult' => $collegesResult,
            'teachersResult' => $teachersResult,
            'courseAuditionResult' => $courseAuditionResult
        ]);
    }

}
