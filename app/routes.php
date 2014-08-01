<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Module Users
 * @namespace T4KControllers\Users
 */
Route::group(array('prefix' => 'users'), function()
{
    // Login screen.
    Route::any('login',         array('as' => 'academy.users.login',		'uses' => 'T4KControllers\Users\UsersController@login'));
    Route::any('connecting',    array('as' => 'academy.users.connecting',	'uses' => 'T4KControllers\Users\UsersController@connecting'));

    // Logout screen.
    Route::any('logout',        array('as' => 'academy.users.logout',		'uses' => 'T4KControllers\Users\UsersController@logout'));
});

Route::group(array('before' => 'auth'), function()
{
    
    /**
     * Module Dashboard
     * @namespace T4KControllers\Dashboard
     */
    Route::any('/',             array('as' => 'academy.dashboard.index',	'uses' => 'T4KControllers\Dashboard\DashboardController@index'));
    Route::any('dashboard',     array('as' => 'academy.dashboard.index',	'uses' => 'T4KControllers\Dashboard\DashboardController@index'));
    
});
