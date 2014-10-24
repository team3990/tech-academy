<?php

namespace T4KControllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

/**
 * T4KControllers\Admin\ProgressController class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    View Controller for the Course model.
 */

class ProgressController extends \BaseController { 
    
    /**
     * Constructor.
     */
    public function __construct() {
        $this->beforeFilter('csrf', array('on' => 'post'));
        setlocale(LC_ALL, 'fr_CA.UTF-8');
    }
    
    /**
     * Display all users.
     * @param string $id
     * @return View Response
     */
	public function index()
	{
		// Retrieve all users
		$users = \T4KModels\User::orderBy('last_name')->orderBy('first_name')->get();
	    
	    // Array of data to send to view
	    $data = array(
	    		'users'				=> $users,
                'ItemsCount'        => \T4KModels\User::count(),
                'currentRoute'      => \Route::currentRouteName(),
                'activeScreen'      => 'AdminIndex'
	    );
	    
	    // Render view
	    $this->layout->content = \View::make('admin.progress.index', $data);
	}
	
	/**
	 * Modify an user progression path.
	 * @param int $id
	 * @return View Response
	 */
	public function edit($id)
	{
	    // Retrieve the user
	    $user = \T4KModels\User::find($id);
	    
	    // Retrieve all subjects
	    $subjects = \T4KModels\Subject::orderBy('title', 'asc')->get();
	    
	    // Array of data to send to view
	    $data = array(
                'user'				=> $user,
	    		'subjects'			=> $subjects,
	    		'ItemsCount'        => 0,
	            'currentRoute'  	=> \Route::currentRouteName(),
                'activeScreen'  	=> 'AdminIndex'
	    );
	     
	    // Render view
	    $this->layout->content = \View::make('admin.progress.form', $data);
	}
	
	/**
	 * Post the updated event item to the DB.
	 * @param int $id
	 * @return Response
	 */
	public function update($id)
	{
		// Retrieve all courses
		$courses = \T4KModels\Course::get();
		
		// Retrieve user
		$user = \T4KModels\User::find($id);
		
		foreach ($courses as $course)
		{
			// Check if there is already a progress for the user and for the course.
		    $completed = \T4KModels\Progress::
		             where('user_id', $id)
		           ->where('course_id', $course->id)
		           ->orderBy('created_at')
		           ->first();
		    
		    // Retrieve value
		    $input = (Input::get($course->id) == NULL) ? 0 : 1;
		    
		    if (isset($completed))
		    {
				$completed->is_completed		= $input;
		        $completed->save();
		    }
		    else
		    {
		    	if ($input != 0)
		    	{
			        $confirming = new \T4KModels\Progress;
			        $confirming->user_id			= $id;
			        $confirming->course_id			= $course->id;
			        $confirming->is_completed		= $input;
			        $confirming->save();
		    	}
		    }
		}

        // Redirect to view screen with success message
        Session::flash('update', true);
        Session::flash('object_name', $user->full_name);
        return Redirect::route('academy.admin.progress.index');
	}
	
	/**
	 * Catch-all method for handling missing methods.
	 * @return Redirect Response
	 */
	public function missingMethod($parameters = array())
	{
	    // Array of data to send to view
	    $data = array(
                'currentRoute'  => \Route::currentRouteName(),
                'activeScreen'  => 'EventsIndex'
	    );
	    
	    // Redirect to Dashboard
	    return Redirect::route('portal.events.index', $data);
	}

}
