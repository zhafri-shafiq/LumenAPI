<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
	protected $fillable = ['name'];

	public $belongsTo = [
		'course' => ['App\Course'],
	];
}