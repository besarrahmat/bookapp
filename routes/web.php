<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Str;

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

$router->get('/key', function () {
    return Str::random(32);
});

$router->get('/books', 'BooksController@index');

$router->get('/books/{id}', 'BooksController@getBook');

$router->post('/books', 'BooksController@store');

$router->put('/books/{id}', 'BooksController@update');

$router->delete('/books/{id}', 'BooksController@destroy');

$router->get('/author', 'AuthorController@index');

$router->get('/author/{id}', 'AuthorController@getAuthor');

$router->post('/author', 'AuthorController@postAuthor');

$router->put('/author/{id}', 'AuthorController@putAuthor');

$router->delete('/author/{id}', 'AuthorController@deleteAuthor');