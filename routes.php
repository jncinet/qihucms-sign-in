<?php

use Illuminate\Routing\Router;

// 接口
Route::group([
    'namespace' => 'Qihucms\SignIn\Controllers\Api',
    'prefix' => 'sign-in',
    'middleware' => ['api'],
], function (Router $router) {
    $router->post('sign', 'SignInController@sign')->name('api.sign.in');
    $router->get('ranking', 'SignInController@ranking')->name('api.sign.ranking');
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