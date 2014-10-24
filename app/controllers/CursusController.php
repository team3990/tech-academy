<?php

namespace T4KControllers\Cursus;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

/**
 * T4KControllers\Cursus\CursusController class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    View Controller for the Cursus model.
 */

class CursusController extends \BaseController { 
    
    /**
     * Constructor.
     */
    public function __construct() {
        $this->beforeFilter('csrf', array('on' => 'post'));
        setlocale(LC_ALL, 'fr_CA.UTF-8');
    }
    
    /**
     * Display all courses.
     * @param string $id
     * @return View Response
     */
	public function index($id = NULL)
	{
	    // Retrieve all subjects
		$subjects = \T4KModels\Subject::orderBy('title', 'asc')->get();
		
		// Retrieve all students
		$students = \T4KModels\User::where('user_role_id', 1)->orderBy('last_name')->orderBy('first_name')->get();
		
		// If a student is currently selected
		$user = ($id == NULL) ? Auth::user() : \T4KModels\User::find($id);
	    
	    // Array of data to send to view
	    $data = array(
	    		'subjects'			=> $subjects,
	    		'students'			=> $students,
	    		'user'				=> $user,
                'ItemsCount'        => \T4KModels\Subject::count(),
                'currentRoute'      => \Route::currentRouteName(),
                'activeScreen'      => 'CursusIndex'
	    );
	    
	    // Render view
	    $this->layout->content = \View::make('cursus.index', $data);
	}
	
	/**
	 * Catch-all method for handling missing methods.
	 * @return Redirect Response
	 */
	public function missingMethod($parameters = array())
	{
	    // Array of data to send to view
	    $data = array(
                'currentRoute'  	=> \Route::currentRouteName(),
                'activeScreen'  	=> 'CursusIndex'
	    );
	    
	    // Redirect to Dashboard
	    return Redirect::route('academy.cursus.index', $data);
	}

}
