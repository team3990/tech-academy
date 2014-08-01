<?php

namespace T4KModels;

/**
 * T4KModels\Page class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    Model Controller managing courses.
 */

class Page extends \Eloquent
{
    
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 't4kacd_pages';
    
    /**
     * Enable model soft deleting functionality.
     */
    use \SoftDeletingTrait;
    
    /**
     * The set of rules to be validated when creating the initial administrator account.
     * @var array
     */
    public static $rules = array(
        'title'             => 'required'
    );
    
    /**
     * The set of messages thrown after rules validation.
     * @var array
     */
    public static $messages = array(
        'title.required'    => 'Le titre de la page est requis.',
    );
            
    /**
     * Relationship to Chapter model.
     * @return Eloquent Relationship
     */
    public function chapter()
    {
    	return $this->belongsTo('\T4KModels\Chapter');
    }
    
    /**
     * Attribute: get the previous page of the current page.
     * @return int|NULL
     */
    public function getPreviousAttribute()
    {
    	// Retrieve the page just before the current page
    	$previous = \T4KModels\Page::where('chapter_id', $this->chapter_id)->where('page_number', '<', $this->page_number)->orderBy('page_number', 'desc')->first();
    	
    	// If the page is the first in its chapter, we must find the last page of the previous chapter
    	if (count($previous) == 0)
    	{
    		// Check to see if the current chapter is not already the first chapter of the course
    		if ($this->chapter->previous != NULL)
    		{
	    		// Get the last page of that previous chapter
	    		$previous = \T4KModels\Page::where('chapter_id', $this->chapter->previous->id)->orderBy('page_number', 'desc')->first();
    		}
    	}
    	
    	return (count($previous) > 0) ? $previous : NULL;
    }
    
    /**
     * Attribute: get the next page of the current page.
     * @return int|NULL
     */
    public function getNextAttribute()
    {
    	// Retrieve the page just after the current page
    	$next = \T4KModels\Page::where('chapter_id', $this->chapter_id)->where('page_number', '>', $this->page_number)->orderBy('page_number', 'asc')->first();
    	
    	// If the page is the last in its chapter, we must find the first page of the next chapter
    	if (count($next) == 0)
    	{
    		// Check to see if the current chapter is not already the last chapter of the course
    		if ($this->chapter->next != NULL)
    		{
	    		// Get the first page of that next chapter
	    		$next = \T4KModels\Page::where('chapter_id', $this->chapter->next->id)->orderBy('page_number', 'asc')->first();
    		}
    	}
    	
    	return (count($next) > 0) ? $next : NULL;
    }
    
}