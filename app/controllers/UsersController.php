<?php

namespace T4KControllers\Users;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

/**
 * T4KControllers\Users\UsersController class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    View Controller managing users login, logout, and users section on the portal, i.e.
 *              user's profile, list of users, etc.
 */

class UsersController extends \BaseController 
{ 
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->beforeFilter('csrf', array('on'=>'post'));
    }
    
    /**
     * Show the login screen.
     * @return View Response
     */
	public function login()
	{
	    $this->layout->content = \View::make('users.login');
	}
	
	/**
	 * Verify the login credentials.
	 * @return Redirect Response
	 */
	public function connecting()
	{
	    if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))) 
	    {
	        return Redirect::intended('/');
	    } 
	    else 
	    {
	        return Redirect::route('academy.users.login')->with('authenticated', false)->withInput();
	    }
	}
	
	/**
	 * Handle logout requests.
	 * @return Redirect Response
	 */
	public function logout()
	{
	    Auth::logout();
	    return Redirect::route('academy.users.login');
	}

}
