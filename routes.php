<?php

use Illuminate\Routing\Router;

// 接口
Route::group([
    'namespace' => 'Qihucms\SignIn\Controllers\Api',
    'prefix' => config('qihu.sign_in_prefix', 'sign'),
    'middleware' => ['api'],
    'as' => 'api.sign.'
], function (Router $router) {
    $router->post('in', 'SignInController@sign')->name('in');
    $router->get('ranking', 'SignInController@ranking')->name('ranking');
});

// 后台
Route::group([
    'prefix' => config('admin.route.prefix') . '/sign-in',
    'namespace' => 'Qihucms\SignIn\Controllers\Admin',
    'middleware' => config('admin.route.middleware'),
    'as' => 'admin.'
], function (Router $router) {
    $router->resource('logs', 'SignInController');
});