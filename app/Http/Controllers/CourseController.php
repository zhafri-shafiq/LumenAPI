<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
	public function index()
	{
		// $courses = Course::all();

		//try with natural join

		$courses["data"] = [
			DB::select(
				"SELECT admin_coursemaker_courses.name, admin_coursemaker_courses.description, system_files.file_name
				FROM admin_coursemaker_courses, system_files 
				WHERE system_files.attachment_id = admin_coursemaker_courses.id 
				AND system_files.attachment_type LIKE '%course';"),
		];

		

		return response()->json($courses);



		/* 
		$courses["data"] = [
			DB::select(
				"SELECT admin_coursemaker_courses.name, admin_coursemaker_courses.description, system_files.attachment_id, system_files.attachment_type 
				FROM admin_coursemaker_courses, system_files 
				WHERE system_files.attachment_id = admin_coursemaker_courses.id 
				AND system_files.attachment_type LIKE '%course';"),
		];

		return response()->json($courses);

		*/



		//mus ajar

		// $courses = 
		// 	json_encode(DB::select(
		// 		"SELECT admin_coursemaker_courses.name, admin_coursemaker_courses.description, system_files.attachment_id, system_files.attachment_type 
		// 		FROM admin_coursemaker_courses, system_files 
		// 		WHERE system_files.attachment_id = admin_coursemaker_courses.id 
		// 		AND system_files.attachment_type LIKE '%course';"));


		// 	 //DB::select('SELECT file_name FROM system_files')
		// 	var_dump($courses);
		
		// $courses2["title"] = $courses['name'];

		// return response()->json($courses2);
	}

	public function getCourse($id)
	{
		// $course = Course::find($id);
		$course = 
			json_encode(DB::select("SELECT admin_coursemaker_lessons.name FROM admin_coursemaker_lessons WHERE admin_coursemaker_lessons.course_id = $id;"));

		var_dump($course);
		$course2["title"] = $course["name"];
		return response()-> json($course2);
	}

	public function saveCourse(Request $request)
	{
		$course = Course::create($request->all());

		return response()->json($course);
	}

	public function deleteCourse($id)
	{
		$course = Course::find($id);

		$course->delete();

		return response()->json('success deleted');
	}

	public function updateCourse(Request $request, $id)
	{
		$course = Course::find($id);

		$course->name = $request->input('name');
		$course->description = $request->input('description');

		$course->save();

		return response()->json($course);
	}
}