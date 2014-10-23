<?php

namespace T4KModels;

/**
 * T4KModels\Progress class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    Model Controller managing courses.
 */

class Progress extends \Eloquent
{
    
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 't4kacd_progress';
    
    /**
     * Enable model soft deleting functionality.
     */
    use \SoftDeletingTrait;
    
    /**
     * Relationship to User model.
     * @return Eloquent Relationship
     */
    public function user()
    {
        return $this->belongsTo('\T4KModels\User');
    }
    
    /**
     * Relationship to Course model.
     * @return Eloquent Relationship
     */
    public function course()
    {
    	return $this->belongsTo('\T4KModels\Course');
    }
    
}