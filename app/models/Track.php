<?php

namespace T4KModels;

/**
 * T4KModels\Track class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    Model Controller managing tracks.
 */

class Track extends \Eloquent
{
    
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 't4kacd_tracks';
    
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
        'title.required'    => 'Le titre de la série est requis.',
    );
    
    /**
     * Relationship to Subject model.
     * @return Eloquent Relationship
     */
    public function subject()
    {
    	return $this->belongsTo('\T4KModels\Subject');
    }
    
    /**
     * Relationship to Subtrack model.
     * @return Eloquent Relationship
     */
    public function subtracks()
    {
    	return $this->hasMany('\T4KModels\Subtrack')->orderBy('number');
    }
    
    /**
     * Relationship to Course model.
     * @return Eloquent Relationship
     */
    public function courses()
    {
    	return $this->hasManyThrough('\T4KModels\Course', '\T4KModels\Subtrack')->orderBy('number');
    }
    
    /**
     * Attribute: get courses linked to a subject.
     * @return Eloquent Object
     */
    public function getCoursesAttribute()
    {
    	$subtracks = $this->subtracks;
    	$results = $subtracks[0]->courses;
    	for ($i = 1; $i < count($subtracks); $i++)
    	{
    	$results = $results->merge($subtracks[$i]->courses);
    	}
    	return $results;
    }
    
}