<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
	protected $fillable = ['name', 'description'];

	public $hasMany = [
		'lesson' => ['App\Lesson'],
		'quiz' => ['App\Quiz'],
	];
}