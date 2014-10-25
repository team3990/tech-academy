<?php

namespace T4KModels;

/**
 * T4KModels\Child class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    Model Controller managing parents and children. 
 */

class Child extends \Eloquent
{

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 't4kglo_user_parent';
    
    /**
     * Enable model soft deleting functionality.
     */
    use \SoftDeletingTrait;
    
    /**
     * Relationship to User model.
     * @return array
     */
    public function user()
    {
        return $this->belongsTo('\T4KModels\User');
    }
    
    /**
     * Relationship to User model.
     * @return array
     */
    public function parent()
    {
    	return $this->belongsTo('\T4KModels\User', 'parent_id');
    }

}
