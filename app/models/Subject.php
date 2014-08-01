<?php

namespace T4KModels;

/**
 * T4KModels\Subject class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    Model Controller managing subjects.
 */

class Subject extends \Eloquent
{
    
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 't4kacd_subjects';
    
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
        'title.required'    => 'Le titre du domaine d\'étude est requis.',
    );
    
    /**
     * Relationship to Course model.
     * @return Eloquent Relationship
     */
    public function courses()
    {
        return $this->hasMany('\T4KModels\Course')->orderBy('class');
    }
    
}