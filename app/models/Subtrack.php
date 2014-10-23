<?php

namespace T4KModels;

/**
 * T4KModels\Subtrack class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    Model Controller managing tracks.
 */

class Subtrack extends \Eloquent
{
    
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 't4kacd_subtracks';
    
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
        'title.required'    => 'Le titre de la sous-série est requis.',
    );
    
    /**
     * Relationship to Track model.
     * @return Eloquent Relationship
     */
    public function track()
    {
    	return $this->belongsTo('\T4KModels\Track');
    }
    
    /**
     * Relationship to Course model.
     * @return Eloquent Relationship
     */
    public function courses()
    {
    	return $this->hasMany('\T4KModels\Course')->orderBy('number');
    }
    
    /**
     * Attribute: get the subject information.
     * @return Eloquent Object
     */
    public function getSubjectAttribute()
    {
    	return $this->track->subject;
    }
    
}