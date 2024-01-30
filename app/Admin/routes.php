<?php

use Encore\Admin\Facades\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('articles', \App\Admin\Controllers\ArticleController::class);
    $router->resource('tags', \App\Admin\Controllers\TagController::class);
    $router->resource('traffic', \App\Admin\Controllers\TrafficController::class);

});
