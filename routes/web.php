<?php
$this->addGroup(['namespace' => 'App\Http\Controllers\Auth'], function () {
    $this->addRoutes('GET', '/', 'AuthController@frontend');
    $this->addRoutes('GET', '/login', 'AuthController@frontendLogin');
    $this->addRoutes('GET', '/logout', 'AuthController@frontendLogout');
    $this->addRoutes('GET', '/backend', 'AuthController@backend');
    $this->addRoutes('POST', '/backend/login', 'AuthController@backendLogin');
    $this->addRoutes('POST', '/backend/visit-login', 'AuthController@backendVisitLogin');
    $this->addRoutes('POST', '/backend/logout', 'AuthController@backendLogout');
});

$this->addGroup(['namespace' => 'App\Http\Controllers\Common'], function () {
    $this->addRoutes('POST', '/upload/{type}/{module}', 'FileController@upload');
    $this->addRoutes('GET', '/download', 'FileController@download');
    $this->addRoutes('GET', '/download/key/{module}/{id}', 'FileController@getKey');
});

$this->addGroup(['namespace' => 'App\Http\Controllers\Frontend'], function () {
    $this->addRoutes('GET', '/website', 'IndexController@website');
    $this->addRoutes('GET', '/about', 'IndexController@about');

    $this->addRoutes('GET', '/articles', 'ArticleController@lists');
    $this->addRoutes('GET', '/article/{id}', 'ArticleController@show');

    $this->addRoutes('GET', '/leaves', 'LeaveController@lists');
    $this->addRoutes('POST', '/leave', 'LeaveController@store');
});

$this->addGroup(['prefix' => '/backend', 'namespace' => 'App\Http\Controllers\Backend', 'middleware' => ['auth.admin', 'auth.checkMethod']], function () {

    // 网站管理模块 
    $this->addRoutes('GET', '/website/setting', 'WebsiteController@showSetting');
    $this->addRoutes('PUT', '/website/setting', 'WebsiteController@saveSetting');
    $this->addRoutes('GET', '/website/dump', 'WebsiteController@dumpIndex');
    $this->addRoutes('GET', '/website/dump/lists', 'WebsiteController@dumpLists');
    $this->addRoutes('DELETE', '/website/dump/{ids}', 'WebsiteController@deleteDump');
    $this->addRoutes('POST', '/website/dump/{type}', 'WebsiteController@dumpDatabase');

    // 管理员模块
    $this->addRoutes('GET', '/admin', 'AdminController@index');
    $this->addRoutes('GET', '/admin/lists', 'AdminController@lists');
    $this->addRoutes('POST', '/admin', 'AdminController@store');
    $this->addRoutes('PUT', '/admin/{id}', 'AdminController@update');
    $this->addRoutes('GET', '/admin/{id}', 'AdminController@show');
    $this->addRoutes('DELETE', '/admin/{ids}', 'AdminController@delete');

    // 角色模块
    $this->addRoutes('GET', '/role', 'RoleController@index');
    $this->addRoutes('GET', '/role/detail/{id}', 'RoleController@detail');
    $this->addRoutes('GET', '/role/lists', 'RoleController@lists');
    $this->addRoutes('POST', '/role', 'RoleController@store');
    $this->addRoutes('DELETE', '/role/{ids}', 'RoleController@delete');

    // 用户模块
    $this->addRoutes('GET', '/user', 'UserController@index');
    $this->addRoutes('GET', '/user/lists', 'UserController@lists');
    $this->addRoutes('GET', '/user/read', 'UserController@readHistory');
    $this->addRoutes('GET', '/user/active', 'UserController@activeHistory');
    $this->addRoutes('GET', '/user/online', 'UserController@onlineHistory');
    $this->addRoutes('GET', '/user/detail/{id}', 'UserController@detail');
    $this->addRoutes('PUT', '/user/{id}', 'UserController@update');
    $this->addRoutes('GET', '/user/{id}', 'UserController@show');
    $this->addRoutes('POST', '/user', 'UserController@store');
    $this->addRoutes('DELETE', '/user/{ids}', 'UserController@delete');

    // 文章模块
    $this->addRoutes('GET', '/article', 'ArticleController@index');
    $this->addRoutes('GET', '/article/lists', 'ArticleController@lists');
    $this->addRoutes('GET', '/article/options', 'ArticleController@options');
    $this->addRoutes('GET', '/article/{id}', 'ArticleController@show');
    $this->addRoutes('PUT', '/article/{id}', 'ArticleController@update');
    $this->addRoutes('POST', '/article', 'ArticleController@store');
    $this->addRoutes('DELETE', '/article/{ids}', 'ArticleController@delete');
    $this->addRoutes('POST', '/article/recycle/{ids}', 'ArticleController@recycle');
    $this->addRoutes('POST', '/article/recover/{ids}', 'ArticleController@recover');

    // 留言模块
    $this->addRoutes('GET', '/leave', 'LeaveController@lists');
    $this->addRoutes('GET', '/leave/lists', 'LeaveController@lists');
    $this->addRoutes('PUT', '/leave/{id}', 'LeaveController@update');
    $this->addRoutes('DELETE', '/leave/{ids}', 'LeaveController@delete');
});
