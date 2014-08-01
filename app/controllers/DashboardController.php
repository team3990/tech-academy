<?php

/**
 * T4KControllers\Dashboard\DashboardController class
 * @author minhnhatbui
 * @copyright 2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract View Controller welcoming the user into the admin section.
 */

namespace T4KControllers\Dashboard;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class DashboardController extends \BaseController { 
    
    /**
     * Constructor.
     */
    public function __construct() {
        $this->beforeFilter('csrf', array('on' => 'post'));
        setlocale(LC_ALL, 'fr_CA.UTF-8');
    }
    
    /**
     * Show the welcome screen.
     * @return View Response
     */
	public function index()
	{	    
	    // Array of data to send to view
	    $data = array(
                'currentRoute'      => \Route::currentRouteName(),
                'activeScreen'      => 'DashboardIndex' 
	    );
	    
	    // Render view
	    $this->layout->content = \View::make('dashboard.index', $data);
	}

}
