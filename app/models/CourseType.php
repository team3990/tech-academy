<?php

namespace T4KModels;

/**
 * T4KModels\CourseType class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    Model Controller managing courses.
 */

class CourseType extends \Eloquent
{
    
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 't4kacd_course_type';
    
    /**
     * Enable model soft deleting functionality.
     */
    use \SoftDeletingTrait;
    
    /**
     * Relationship to Course model.
     * @return Eloquent Relationship
     */
    public function courses()
    {
        return $this->hasMany('\T4KModels\Course');
    }
        
}