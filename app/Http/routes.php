<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
//前端页面
Route::group(['namespace' => 'Home'],function(){
    Route::Controller('user','UserController');
    Route::post('follow',[
        'as'=>'follow','uses'=>'FollowController@store'
    ]);
    Route::post('unfollow',[
        'as'=>'unfollow','uses'=>'FollowController@destroy'
    ]);

    Route::get('search',[
        'as'=>'search','uses'=>'SearchController@index'
    ]);
    Route::get('search/result',[
        'as'=>'search.search','uses'=>'SearchController@search'
    ]);

    Route::get('activity/{id}',[
        'as'=>'activity.action','uses'=>'EventController@activity'
    ]);

    Route::post('activity/action',[
        'as'=>'activity.start','uses'=>'EventController@start'
    ]);
});

Route::get('posts','Home\PostController@all');
Route::get('posts/{nodeId?}', 'Home\PostController@postsList');


//微信入口

Route::group(['namespace' => 'Wechat'],function(){
    Route::match(['get','post'],'wechat/auth/{wechatId}','WechatController@index');

    Route::post('reply/{message}',[
        'as'=>'reply','uses'=>'WechatController@reply'
    ]);
});


/*
 * Ucenter
 * */
Route::group(['namespace' => 'Ucenter','prefix' => 'ucenter'],function(){

    Route::get('/',[
        'as'=>'ucenter','uses'=>'UserController@index'
    ]);

    Route::resource('wechat', 'WechatController',['names'=>['index'=>'ucenter.wechat']]);

    Route::get('/wechat/{wechatId}/manage',[
        'as'=>'ucenter.wechat.manage','uses'=>'WechatController@manage'
    ]);

    //素材管理
    Route::get('/wechat/{wechatId}/media',[
        'as'=>'ucenter.wechat.media','uses'=>'WechatController@media'
    ]);
    //素材管理类型
    Route::get('/wechat/{wechatId}/media/{type}',[
        'as'=>'ucenter.wechat.media.type','uses'=>'WechatController@mediaType'
    ]);

    //微信图文消息资源

    Route::resource('wechat.news', 'NewsController',['names'=>['index'=>'ucenter.wechat.news']]);

    //回复类型
    Route::get('/wechat/{wechatId}/reply',[
        'as'=>'ucenter.wechat.reply','uses'=>'WechatController@reply'
    ]);

    Route::get('/wechat/{wechatId}/reply/{type}',[
        'as'=>'ucenter.wechat.reply.type','uses'=>'WechatController@replyType'
    ]);

    Route::post('/wechat/{wechatId}/ruleStore',[
        'as'=>'ucenter.wechat.rule-store','uses'=>'WechatController@ruleStore'
    ]);
    Route::post('/wechat/{wechatId}/keywordsStore',[
        'as'=>'ucenter.wechat.keywords-store','uses'=>'WechatController@keywordsStore'
    ]);
    //编辑关键字
    Route::post('/wechat/{wechatId}/keywords-update',[
        'as'=>'ucenter.wechat.keywords-update','uses'=>'WechatController@keywordsUpdate'
    ]);

    //回复文字
    Route::post('/wechat/{wechatId}/reply-text',[
        'as'=>'ucenter.wechat.reply-text','uses'=>'WechatController@replyText'
    ]);
    //回复图文
    Route::post('/wechat/{wechatId}/reply-news',[
        'as'=>'ucenter.wechat.reply-news','uses'=>'WechatController@replyNews'
    ]);
});

//==================================================================//

Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware' => 'auth'],function(){

    Route::get('/', 'AdminController@index');

    Route::get('user',[
        'as'=>'admin.user','uses'=>'UserController@index'
    ]);
    Route::get('user/create',[
        'as'=>'admin.user.create','uses'=>'UserController@create'
    ]);
    Route::post('user/store',[
        'as'=>'admin.user.store','uses'=>'UserController@store'
    ]);
    Route::get('user/{id}/edit',[
        'as'=>'admin.user.edit','uses'=>'UserController@edit'
    ]);
    Route::post('user/update',[
        'as'=>'admin.user.update','uses'=>'UserController@update'
    ]);
    Route::get('user/{id}/profile',[
        'as'=>'admin.user.profile','uses'=>'UserController@profile'
    ]);

    /*
     *角色部分
     */
    Route::get('role',[
        'as'=>'admin.role','uses'=>'RoleController@index'
    ]);
    Route::get('role/create',[
        'as'=>'admin.role.create','uses'=>'RoleController@create'
    ]);
    Route::post('role/store',[
        'as'=>'admin.role.store','uses'=>'RoleController@store'
    ]);
    Route::get('role/{id}/edit',[
        'as'=>'admin.role.edit','uses'=>'RoleController@edit'
    ]);
    Route::post('role/update',[
        'as'=>'admin.role.update','uses'=>'RoleController@update'
    ]);
    Route::get('role/{id}/can',[
        'as'=>'admin.role.can','uses'=>'RoleController@can'
    ]);
    Route::post('role/updateCan',[
        'as'=>'admin.role.updateCan','uses'=>'RoleController@updateCan'
    ]);
    Route::post('role/{id}/destroy',[
        'as'=>'admin.role.destroy','uses'=>'RoleController@destroy'
    ]);
    /*
     * 权限部分
     *
     */
    Route::get('permission',[
        'as'=>'admin.permission','uses'=>'PermissionController@index'
    ]);
    Route::get('permission/create',[
        'as'=>'admin.permission.create','uses'=>'PermissionController@create'
    ]);
    Route::post('permission/store',[
        'as'=>'admin.permission.store','uses'=>'PermissionController@store'
    ]);
    Route::get('permission/{id}/edit',[
        'as'=>'admin.permission.edit','uses'=>'PermissionController@edit'
    ]);
    Route::post('permission/update',[
        'as'=>'admin.permission.update','uses'=>'PermissionController@update'
    ]);

     ///
    Route::get('user/test',[
        'as'=>'admin.user.test','uses'=>'UserController@test'
    ]);

    Route::resource('post', 'PostController',['names'=>['index'=>'admin.post']]);

    Route::get('node/create/{id?}',[
        'as'=>'admin.node.new','uses'=>'NodeController@newsub'
    ]);

    Route::resource('node', 'NodeController',['names'=>['index'=>'admin.node']]);

    // 操作文件
    Route::get('keyword',[
        'as'=>'admin.keyword','uses'=>'KeywordController@index'
    ]);
    Route::post('keyword',[
        'as'=>'admin.keyword.store','uses'=>'KeywordController@putContent'
    ]);

    Route::get('wechat',[
        'as'=>'admin.wechat','uses'=>'WechatController@index'
    ]);
    //微信用户
    Route::resource('wechat-user', 'WechatUserController',['names'=>['index'=>'admin.wechat-user']]);

    //公众号
    Route::get('wechat/public',[
        'as'=>'admin.public','uses'=>'WechatController@index'
    ]);
    Route::get('wechat/public/create',[
        'as'=>'admin.public.create','uses'=>'WechatController@create'
    ]);
    Route::post('wechat/public/store',[
        'as'=>'admin.public.store','uses'=>'WechatController@store'
    ]);
    Route::get('wechat/public/{id}/edit',[
        'as'=>'admin.public.edit','uses'=>'WechatController@edit'
    ]);
    Route::post('wechat/public/{id}/update',[
        'as'=>'admin.public.update','uses'=>'WechatController@update'
    ]);
    Route::get('wechat/public/{id}/destroy',[
        'as'=>'admin.public.destroy','uses'=>'WechatController@destroy'
    ]);
    //自动回复
    Route::get('wechat-reply/subscribe/create',[
        'as'=>'admin.wechat-reply.subscribeCreate','uses'=>'WechatReplyController@subscribeCreate'
    ]);
    Route::post('wechat-reply/subscribe/store',[
        'as'=>'admin.wechat-reply.subscribeStore','uses'=>'WechatReplyController@subscribeStore'
    ]);
    Route::post('wechat-reply/subscribe/update',[
        'as'=>'admin.wechat-reply.subscribeUpdate','uses'=>'WechatReplyController@subscribeUpdate'
    ]);
    //回复规则
    Route::get('wechat-reply/rule',[
        'as'=>'admin.wechat-reply.rule','uses'=>'WechatRuleController@index'
    ]);
    Route::post('wechat-reply/rule/createOrEdit',[
        'as'=>'admin.wechat-reply.rule-createOrEdit','uses'=>'WechatRuleController@createOrEdit'
    ]);
    Route::post('wechat-reply/rule/store',[
        'as'=>'admin.wechat-reply.rule-store','uses'=>'WechatRuleController@store'
    ]);
    Route::resource('wechat-reply', 'WechatReplyController',['names'=>['index'=>'admin.wechat-reply']]);

    //自定义菜单
    //推送菜单
    Route::get('wechat-menu/push',[
        'as'=>'admin.wechat-menu.push','uses'=>'WechatMenuController@push'
    ]);
    //子菜单
    Route::get('wechat-menu/{id}/sub-menu',[
        'as'=>'admin.wechat-menu.sub-menu','uses'=>'WechatMenuController@subMenu'
    ]);
    Route::get('wechat-menu/{id}/sub-create',[
        'as'=>'admin.wechat-menu.sub-create','uses'=>'WechatMenuController@subCreate'
    ]);
    Route::resource('wechat-menu', 'WechatMenuController',['names'=>['index'=>'admin.wechat-menu']]);

    //群发
    Route::resource('wechat-send', 'WechatSendController',['names'=>['index'=>'admin.wechat-send']]);

    //chexi
    Route::resource('series', 'SeriesController',['names'=>['index'=>'admin.series']]);

    //客服
    Route::post('wechat-staff/upload',[
        'as'=>'admin.wechat-staff.upload','uses'=>'WechatStaffController@upload'
    ]);

    Route::post('wechat-staff/invite-create',[
        'as'=>'admin.wechat-staff.invite-create','uses'=>'WechatStaffController@inviteCreate'
    ]);
    Route::post('wechat-staff/invite-store',[
        'as'=>'admin.wechat-staff.invite-store','uses'=>'WechatStaffController@inviteStore'
    ]);
    Route::resource('wechat-staff', 'WechatStaffController',['names'=>['index'=>'admin.wechat-staff']]);
    Route::resource('wechat-news', 'WechatNewsController',['names'=>['index'=>'admin.wechat-news']]);

});

/*文件上传*/
Route::post('upload',[
    'as'=>'upload','uses'=>'UploadController@upload'
]);
Route::post('uploadfile',[
    'as'=>'uploadfile','uses'=>'UploadController@upload'
]);


//Route::get('search/{keyword}','SearchController@search');

Route::get('angular',function(){
    return view('admin.test.index');
});