<?php 

namespace App\Transformers;

use Carbon\Carbon;

class ProjectTransformer extends Transformer {

	public function transform($item)
	{
		return [
			'id' => isset($item['id']) ? $item['id'] : 0,
			'title' => $item['title'],
			'plan_id' => $item['plan_id'],
			'description' => $item['description'],
			'award_on' => isset($item['award_on']) ? Carbon::createFromFormat('d/m/Y', $item['award_on']) : Carbon::now(),
			
			'duration_type' => $item['duration_type'],
			'duration_length' => $item['duration_length'],
			'skills' => json_decode($item['skills']),
		];
	}
	
}