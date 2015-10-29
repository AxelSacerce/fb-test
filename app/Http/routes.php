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

Route::get('/', function () {
    return view('welcome');
});

Route::get('auth/facebook', 'SocialController@redirectToProvider');
Route::get('auth/facebook/callback','SocialController@handleProviderCallback');


Route::group(['middleware' => 'auth'],function()
    {
      // Se cumplirá solo si el usuario ha iniciado sesion
      Route::get('ingreso', function ()
        {
            return view('usuarios.ingreso');
      
        }); 
        
        /*Route::get('share', function ()
        {
            return view('usuarios.share');
      
        });  */
    });

      