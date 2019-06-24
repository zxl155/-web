<?php
use think\Route;
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------


Route::rule('/','home/Index/indexShow');
Route::rule('yxzx/:id/:page','home/Index/detailsList');
Route::rule('hdgg/:id/:page','home/Index/detailsList');
Route::rule('txxw/:id/:page','home/Index/detailsList');
Route::rule('szjs/:id/:page','home/Index/detailsList');
Route::rule('hdtp/:id/:page','home/Index/detailsList');
Route::rule('zsxx/:id/:page','home/Index/detailsList');
Route::rule('szss/:id/:page','home/Index/detailsList');
Route::rule('glzk/:id/:page','home/Index/detailsList');
Route::rule('qynx/:id/:page','home/Index/detailsList');
Route::rule('kcst/:id/:page','home/Index/detailsList');

Route::rule('yxzx/:id','home/Index/contentDetails');
Route::rule('hdgg/:id','home/Index/contentDetails');
Route::rule('txxw/:id','home/Index/contentDetails');
Route::rule('szjs/:id','home/Index/contentDetails');
Route::rule('hdtp/:id','home/Index/contentDetails');
Route::rule('zsxx/:id','home/Index/contentDetails');
Route::rule('szss/:id','home/Index/contentDetails');
Route::rule('glzk/:id','home/Index/contentDetails');
Route::rule('qynx/:id','home/Index/contentDetails');
Route::rule('kcst/:id','home/Index/contentDetails');

Route::rule('yxzx','home/Index/detailsList?id=1');
Route::rule('hdgg','home/Index/detailsList?id=3');
Route::rule('txxw','home/Index/detailsList?id=4');
Route::rule('szjs','home/Index/detailsList?id=5');
Route::rule('hdtp','home/Index/detailsList?id=6');
Route::rule('zsxx','home/Index/detailsList?id=7');
Route::rule('szss','home/Index/detailsList?id=8');
Route::rule('glzk','home/Index/detailsList?id=9');
Route::rule('qynx','home/Index/detailsList?id=10');
Route::rule('kcst','home/Index/detailsList?id=11');

Route::rule('introduce','home/Index/introduceShow');



