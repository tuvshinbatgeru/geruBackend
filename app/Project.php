<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $primaryKey = 'id';
	protected $table = 'project';

	protected $fillable = [
        'plan_id', 'title', 'identity_code','description', 'award_on', 'duration_type', 'duration_length','status'
	];
	
    //
    public function skills()
    {
    	return $this->belongsToMany('App\Skill');
    }

}
