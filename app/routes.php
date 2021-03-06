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
    Route::any('login',         	array('as' => 'academy.users.login',		'uses' => 'T4KControllers\Users\UsersController@login'));
    Route::any('connecting',    	array('as' => 'academy.users.connecting',	'uses' => 'T4KControllers\Users\UsersController@connecting'));

    // Logout screen.
    Route::any('logout',        	array('as' => 'academy.users.logout',		'uses' => 'T4KControllers\Users\UsersController@logout'));
});

/**
 * Module Dashboard
 * @namespace T4KControllers\Dashboard
 */
Route::any('/',             		array('as' => 'academy.dashboard.index',	'uses' => 'T4KControllers\Dashboard\DashboardController@index'));
Route::any('dashboard',     		array('as' => 'academy.dashboard.index',	'uses' => 'T4KControllers\Dashboard\DashboardController@index'));

/**
 * Module Courses
 * @namespace T4KControllers\Courses
 */
Route::group(array('prefix' => 'cours'), function()
{
	Route::any('/{id?}',										array('as' => 'academy.courses.index',		'uses' => 'T4KControllers\Courses\CoursesController@index'));
	Route::any('/view/{course_id}/{chapter_id?}/{page_id?}',	array('as' => 'academy.courses.view',		'uses' => 'T4KControllers\Courses\CoursesController@view'));
});

Route::group(array('before' => 'auth'), function()
{
	/**
	 * Module Cursus
	 * @namespace T4KControllers\Cursus
	 */
	Route::group(array('prefix' => 'cursus'), function()
	{
		Route::any('/{id?}',				array('as' => 'academy.cursus.index',		'uses' => 'T4KControllers\Cursus\CursusController@index'));
	});
	
	/**
	 * Module Administration
	 * @namespace T4KControllers\Admin
	 */
	Route::group(array('prefix' => 'admin'), function()
	{
		Route::group(array('prefix' => 'progression'), function()
		{
			Route::any('/',						array('as' => 'academy.admin.progress.index',		'uses' => 'T4KControllers\Admin\ProgressController@index'));
			Route::any('modifier/{id}',         array('as' => 'academy.admin.progress.edit',		'uses' => 'T4KControllers\Admin\ProgressController@edit'));
			Route::any('modifier/save/{id}',    array('as' => 'academy.admin.progress.update',		'uses' => 'T4KControllers\Admin\ProgressController@update'));
		});
	});
	
});
