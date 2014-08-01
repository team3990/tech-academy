<?php

namespace T4KModels;

/**
 * T4KModels\Chapter class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    Model Controller managing chapters.
 */

class Chapter extends \Eloquent
{
    
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 't4kacd_chapters';
    
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
        'title.required'    => 'Le titre du chapitre est requis.',
    );
        
    /**
     * Relationship to Course model.
     * @return Eloquent Relationship
     */
    public function course()
    {
    	return $this->belongsTo('\T4KModels\Course');
    }
    
    /**
     * Relationship to Page model.
     * @return Eloquent Relationship
     */
    public function pages()
    {
    	return $this->hasMany('\T4KModels\Page')->orderBy('page_number');
    }
    
    /**
     * Attribute: get the previous chapter of the current chapter.
     * @return int|NULL
     */
    public function getPreviousAttribute()
    {
    	// Retrieve the chapter just before the current chapter
    	$previous = \T4KModels\Chapter::
    			  where('course_id', $this->course_id)
    			->where('chapter_number', '<', $this->chapter_number)
    			->orderBy('chapter_number', 'desc')
    			->first();
    	 
    	return (count($previous) > 0) ? $previous : NULL;
    }
    
    /**
     * Attribute: get the next page of the current page.
     * @return int|NULL
     */
    public function getNextAttribute()
    {
    	// Retrieve the chapter just after the current chapter
		$next = \T4KModels\Chapter::
    			  where('course_id', $this->course_id)
    			->where('chapter_number', '>', $this->chapter_number)
    			->orderBy('chapter_number', 'asc')
    			->first();
    	 
    	return (count($next) > 0) ? $next : NULL;
    }
    
}