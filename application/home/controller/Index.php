<?php
namespace app\home\controller;

use app\home\model\Banner;
use app\home\model\Colimu;
use app\home\model\Article;
use think\Request;

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
        $colimuResult = Colimu::colimuList();
        //获取活动公共
        $activityResult = Article::ArticleList(3,'id,name,content',4);
        $strActivity = '';
        foreach ($activityResult as $activityKey => $activityValue) {
            preg_match_all("/[\x{4e00}-\x{9fa5}]+/u", $activityValue['content'], $result);
            if (!empty($result[0])) {
                $strActivity = implode($result[0],'');
                $strActivity = str_replace('宋体','',$strActivity);
            }

            $activityResult[$activityKey]['content'] = substr_replace($strActivity,'...',75);
        }

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
        $strTeachers = '';
        foreach ($teachersResult as $teachersKey => $teachersValue) {
            preg_match_all("/[\x{4e00}-\x{9fa5}]+/u", $teachersValue['content'], $result);
            if (!empty($result[0])) {
                $strTeachers = implode($result[0],'');
                $strTeachers = str_replace('宋体','',$strTeachers);
            }

            $teachersResult[$teachersKey]['content'] = substr_replace($strTeachers,'...',30);
        }
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
    /**
     * 详情列表
     * @time 2019-06-15
     * @param $colimu_id 列表ID
     * @param $count 每页显示条数
     * @param $maxId 下一页
     * @param $minId 上一页
     * @return
     */
    public function detailsList(Request $request)
    {
       $colimu_id = empty($request->param('id')) ? 0 : $request->param('id');
       $page_size = empty($request->param('page_size')) ? 9 : $request->param('page_size');
       $page      = empty($request->param('page')) ? 1 : $request->param('page');

       //单条信息
       $colimuResult  = Colimu::oneList($colimu_id);

       if ($colimuResult[0]['type'] == 1) {
           //详情列表
           $data = Article::detailsList($colimu_id,$page,$page_size,'id,name');

           return $this->fetch('InstitutionalDetails',['articleResult' => $data['result'],
               'colimuResult' => $colimuResult,
               'columnUrl' => $colimuResult[0]['column_url'],
               'page' => $page,
               'countPage' => $data['countPage'],
           ]);

       } else if ($colimuResult[0]['type'] == 2) {
           //详情列表
           $data = Article::detailsList($colimu_id,$page,6,'id,picture_url');

           return $this->fetch('pictureDetails',['articleResult' => $data['result'],
               'colimuResult' => $colimuResult,
               'columnUrl' => $colimuResult[0]['column_url'],
               'page' => $page,
               'countPage' => $data['countPage']
           ]);

       } else if ($colimuResult[0]['type'] == 3) {
           //详情列表
           $data = Article::detailsList($colimu_id,$page,5,'id,name,content,picture_url');

           return $this->fetch('teachersDetails',['articleResult' => $data['result'],
               'colimuResult' => $colimuResult,
               'columnUrl' => $colimuResult[0]['column_url'],
               'page' => $page,
               'countPage' => $data['countPage']
           ]);
       }



    }
    /**
     * 院校介绍
     * @time 2019-06-17
     * @return
     */
    public function introduceShow()
    {
        $recommendResult = Article::ArticleList(1,'id,name,colimu_id',5,1);
        foreach ($recommendResult as $key => $value)
        {
            //单条信息
            $colimuResult  = Colimu::oneList($value['colimu_id']);
            $recommendResult[$key]['column_url'] = $colimuResult[0]['column_url'];
        }

        return $this->fetch('collegesIntroduce',['recommendResult' => $recommendResult]);
    }
    /**
     * 文章详情
     * @time 2019-06-17
     * @return
     */
    public function contentDetails(Request $request)
    {
        $article_id = empty($request->param('id')) ? 0 : $request->param('id');

        //内容
        $contentResult = Article::contentDetails($article_id,'id,name,content,create_time,colimu_id');
        //相关文章
        $relevantResult = Article::detailsList($contentResult[0]['colimu_id'],1,5,'id,name');
        //获取当前文章前一条数据跟后一条数据
        $aroundResult = Article::aroundList($article_id,$contentResult[0]['colimu_id']);
        //单条信息
        $colimuResult  = Colimu::oneList($contentResult[0]['colimu_id']);

        return $this->fetch('contentDetails',['contentResult' => $contentResult,
            'relevantResult' => $relevantResult['result'],
            'colimuId' => $contentResult[0]['colimu_id'],
            'aroundResult' => $aroundResult,
            'columnUrl' => $colimuResult[0]['column_url']
        ]);
    }

}
