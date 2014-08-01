<?php

namespace T4KModels;

/**
 * T4KModels\Course class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    Model Controller managing courses.
 */

class Course extends \Eloquent
{
    
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 't4kacd_courses';
    
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
        'title.required'    => 'Le titre du cours est requis.',
    );
    
    /**
     * Relationship to Teacher model.
     * @return Eloquent Relationship
     */
    public function teachers()
    {
        return $this->belongsToMany('\T4KModels\Teacher', 't4kacd_course_user', 'course_id', 'user_id')->orderBy('last_name')->orderBy('first_name');
    }
    
    /**
     * Relationship to Subject model.
     * @return Eloquent Relationship
     */
    public function subject()
    {
    	return $this->belongsTo('\T4KModels\Subject');
    }
    
    /**
     * Relationship to CourseType model.
     * @return Eloquent Relationship
     */
    public function type()
    {
    	return $this->belongsTo('\T4KModels\CourseType', 'course_type_id', 'id');
    }
    
}