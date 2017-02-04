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
		$courses["data"] = [
			DB::select('SELECT admin_coursemaker_courses.name, admin_coursemaker_courses.description, system_files.file_name FROM admin_coursemaker_courses, system_files'),


			// DB::select('SELECT file_name FROM system_files')
			
		];
		
		return response()->json($courses);
	}

	public function getCourse($id)
	{
		// $course = Course::find($id);

		$course = DB::select("SELECT name, description FROM admin_coursemaker_courses WHERE id = $id");
		return response()-> json($course);
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