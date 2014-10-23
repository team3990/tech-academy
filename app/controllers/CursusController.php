<?php

namespace T4KControllers\Courses;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

/**
 * T4KControllers\Courses\CoursesController class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    View Controller for the Course model.
 */

class CoursesController extends \BaseController { 
    
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
	public function index()
	{
	    // Retrieve all courses
    	$courses = \T4KModels\Course::orderBy('subject_id')->orderBy('class')->get();

		// Subjects
		$subjects = \T4KModels\Subject::orderBy('title', 'asc')->get();
	    
	    // Array of data to send to view
	    $data = array(
                'courses'   		=> $courses,
	    		'subjects'			=> $subjects,
                'ItemsCount'        => NULL,
                'currentRoute'      => \Route::currentRouteName(),
                'activeScreen'      => 'CursusIndex'
	    );
	    
	    // Render view
	    $this->layout->content = \View::make('cursus.index', $data);
	}
	
	/**
	 * View a course.
	 * @param int $id
	 * @return View Response
	 */
	public function view($course_id, $chapter_id = NULL, $page_id = NULL)
	{
		// Retrieve a course with its course_id
		$course = \T4KModels\Course::find($course_id);
		
		// Retrieve a chapter with its chapter_id
		if ($chapter_id !== NULL) $chapter = \T4KModels\Chapter::find($chapter_id);
		
		// Retrieve a page with its page_id
		if ($page_id !== NULL) $page = \T4KModels\Page::find($page_id);
	
		// Array of data to send to view
		$data = array(
				'course'       	=> $course,
				'chapter'		=> @$chapter,
				'page'			=> @$page,
				'currentRoute'  => \Route::currentRouteName(),
				'activeScreen'  => 'CursusIndex'
		);
	
		// Render view
		if (!$course->is_private || ($course->is_private && Auth::check()))
		{
			$this->layout->content = \View::make('courses.view', $data);
		}
		else
		{
			return Redirect::route('academy.users.login');
		}
	}
	
	/**
	 * Create a event item.
	 * @return View Response
	 */
	public function create()
	{
	    // Array of data to send to view
	    $data = array(
                'currentRoute'  => \Route::currentRouteName(),
                'activeScreen'  => 'EventsIndex'
	    );
	     
	    // Render view
	    $this->layout->content = \View::make('events.form', $data);
	}
	
	/**
	 * Post the new event item in DB.
	 * @return Response
	 */
	public function store()
	{
	    // Validation rules
	    $validator = Validator::make(Input::all(), \T4KModels\Event::$rules, \T4KModels\Event::$messages);
	
	    // Validator check
	    if ($validator->fails())
	    {
	        // Throw error and redirect to previous screen
	        return Redirect::route('portal.events.create')->withErrors($validator)->withInput();
	    }
	    else
	    {
	        // Create new object from model and save it
	        $event = new \T4KModels\Event;
	        $event->user_id        = Auth::user()->id;
	        $event->datetime_start = Input::get('datetime_start');
	        $event->datetime_end   = Input::get('datetime_end');
	        $event->title          = Input::get('title');
	        $event->content        = Input::get('content');
	        $event->save();
	        $event = \T4KModels\Event::find($event->id);
	        
	        // Send email: preparing data
	        $mail_subject = $event->title.', le '.mb_strtolower(strftime('%A %e %B %Y, de %H h %M', strtotime($event->datetime_start))).' à '.mb_strtolower(strftime('%H h %M', strtotime($event->datetime_end)));
	        $users = \T4KModels\User::where('id', 3)->get();
    	    $link = (Input::get('datetime_end') >= date('Y-m-d H:i:s')) ? route('portal.events.upcoming', $event->id) : $link = route('portal.events.past', $event->id);
	        
	        // Sending email to each user
	        foreach ($users as $user)
	        {
	            if ($user->is_mentor || $user->is_junior_mentor || $user->is_student)
	            {
    	            // Array of data to send to email
    	            $data = array(
    	                    'event'        => $event,
    	                    'user'         => $user,
    	                    'link'         => $link
    	            );
    	            
    	            // Sending mail
        	        Mail::send('emails.events.new', $data, function($message) use ($user, $mail_subject)
        	        {
        	            $message->from('no-reply@team3990.com', 'Equipe Team 3990: Tech for Kids');
        	            $message->to($user->email);
        	            $message->subject($mail_subject);
        	        });
	            }
	        }
	
	        // Redirect to view screen with success message
	        Session::flash('store', true);
	        if (Input::get('datetime_end') >= date('Y-m-d H:i:s'))
	        {
	           return Redirect::route('portal.events.upcoming', $event->id);
	        }
	        else 
	        {
	            return Redirect::route('portal.events.past', $event->id);
	        }
	    }
	}
	
	/**
	 * Modify an existing event item.
	 * @param int $id
	 * @return View Response
	 */
	public function edit($id)
	{
	    // Retrieve the event item with its id
	    $event = \T4KModels\Event::find($id);
	     
	    // Array of data to send to view
	    $data = array(
                'event'         => $event,
	            'currentRoute'  => \Route::currentRouteName(),
                'activeScreen'  => 'EventsIndex'
	    );
	     
	    // Render view
	    $this->layout->content = \View::make('events.form', $data);
	}
	
	/**
	 * Post the updated event item to the DB.
	 * @param int $id
	 * @return Response
	 */
	public function update($id)
	{
	    // Validation rules
	    $validator = Validator::make(Input::all(), \T4KModels\Event::$rules, \T4KModels\Event::$messages);
	
	    // Validator check
	    if ($validator->fails())
	    {
	        // Throw error and redirect to previous screen
	        return Redirect::route('portal.events.edit', $id)->withErrors($validator)->withInput();
	    }
	    else
	    {
	        // Retrieve object from model and update it
	        $event = \T4KModels\Event::find($id);
	        $event->datetime_start = Input::get('datetime_start');
	        $event->datetime_end   = Input::get('datetime_end');
	        $event->title          = Input::get('title');
	        $event->content        = Input::get('content');
	        $event->save();
	
	        // Redirect to view screen with success message
	        Session::flash('update', true);
            if (Input::get('datetime_end') >= date('Y-m-d H:i:s'))
            {
               return Redirect::route('portal.events.upcoming', $event->id);
            }
            else 
            {
                return Redirect::route('portal.events.past', $event->id);
            }
	    }
	}
	
	/**
	 * Soft destroy a event item.
	 * @param int $id
	 * @return Response
	 */
	public function destroy($id)
	{
	    // Retrieve object
	    $event = \T4KModels\Event::where('id', $id)->first();
	    Session::flash('object_name', $event->title);
	    
	    // Delete object
	    $event->delete();
	
	    // Redirect to view screen with success message
	    Session::flash('destroy', true);
	    return Redirect::route('portal.events.index');
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
