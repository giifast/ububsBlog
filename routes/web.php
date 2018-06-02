<?php
$this->addGroup(['prefix' => '/backend', 'namespace' => 'App\Http\Controllers\Auth'], function () {
    $this->addRoutes('GET', '/', 'AuthController@backend');
    $this->addRoutes('POST', '/login', 'AuthController@backendLogin');
    $this->addRoutes('POST', '/logout', 'AuthController@backendLogout');
});

$this->addGroup(['namespace' => 'App\Http\Controllers\Frontend'], function () {
    $this->addRoutes('GET', '/', 'IndexController@index');
    $this->addRoutes('GET', '/test', 'IndexController@test');
});

$this->addGroup(['prefix' => '/backend', 'namespace' => 'App\Http\Controllers\Backend'], function () {
	// 管理员模块
    $this->addRoutes('GET', '/admin', 'AdminController@index');
    $this->addRoutes('GET', '/admin/detail/{id}', 'AdminController@detail');
    $this->addRoutes('GET', '/admin/lists', 'AdminController@lists');
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
    $this->addRoutes('GET', '/user/{id}', 'UserController@show');
    $this->addRoutes('GET', '/user/detail/{id}', 'UserController@detail');
    $this->addRoutes('GET', '/user/read/{id}', 'UserController@readHistory');
    $this->addRoutes('GET', '/user/active/{id}', 'UserController@activeHistory');
    $this->addRoutes('GET', '/user/online/{id}', 'UserController@onlineHistory');
    $this->addRoutes('PUT', '/user/{id}', 'UserController@update');
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
    $this->addRoutes('DELETE', '/article/recycle/{ids}', 'ArticleController@recycle');
});

$this->addRoute('GET', '/frontend', function () {
    echo 'success';
});
