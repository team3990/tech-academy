<?php

namespace T4KModels;

/**
 * T4KModels\Teacher class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    Model Controller managing teachers.
 */

class Teacher extends \Eloquent
{
    
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 't4kglo_users';
    
    /**
     * Enable model soft deleting functionality.
     */
    use \SoftDeletingTrait;
    
    /**
     * Read-only mode.
     * @var array
     */
    protected $guarded = array('*');
    
    /**
     * Relationship to Course model.
     * @return Eloquent Scope
     */
    public function courses()
    {
        return $this->belongsToMany('\T4KModels\Course', 't4kacd_course_teacher', 'user_id', 'course_id')->orderBy('title');
    }
    
    /**
     * Accessor: user's full name
     * @param Collection Object $value
     * @return string
     */
    public function getFullNameAttribute($value)
    {
    	return $this->first_name.' '.$this->last_name;
    }
    
}