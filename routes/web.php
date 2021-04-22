<?php
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
 
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
 
$router->get('/', function () use ($router) {
    return $router->app->version();
});


//firebase route
    $router->get('api/store',  ['uses' => 'StoreController@index']);
    $router->post('api/store',  ['uses' => 'StoreController@insert']);
    $router->get('api/store',  ['uses' => 'StoreController@index']);
    $router->get('api/store/{uid}',  ['uses' => 'StoreController@show']);
    $router->patch('api/store/{uid}',  ['uses' => 'StoreController@update']);
    $router->patch('api/store/delete/{uid}',  ['uses' => 'StoreController@delete']);

    // $router->get('test/product',  ['uses' => 'ProductController@index']);
    // $router->post('test/product',  ['uses' => 'ProductController@insert']);
    // $router->get('test/product/{_id}',  ['uses' => 'ProductController@show']);
    // $router->patch('test/product/{_id}',  ['uses' => 'ProductController@update']);
    // $router->patch('test/product/delete/{_id}',  ['uses' => 'ProductController@destroy']);