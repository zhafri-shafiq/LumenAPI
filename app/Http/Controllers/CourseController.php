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
				"SELECT admin_coursemaker_courses.name, admin_coursemaker_courses.description,
				a.file_name AS 'image', b.file_name AS 'video'

				FROM admin_coursemaker_courses, system_files a, system_files b

				WHERE a.attachment_id = admin_coursemaker_courses.id 
				AND a.attachment_type LIKE '%course'
				 AND a.content_type LIKE 'image%' AND b.attachment_id = admin_coursemaker_courses.id AND b.attachment_type LIKE '%course'
				 AND b.content_type LIKE 'video%'"),
		];

		//var_dump($courses);

		// $courses2 = [DB::select(
			// "SELECT admin_coursemaker_courses.name
			// FROM admin_coursemaker_courses")];
		// json_encode($courses2['name']);

		// $courses3 = [DB::select(
			// "SELECT admin_coursemaker_courses.description
		 	// FROM admin_coursemaker_courses")];
		// json_encode($courses2['description']);

		// $courses4 = [DB::select(
			// "SELECT system_files.file_name
		 	// FROM system_files, admin_coursemaker_courses
		 	// WHERE system_files.attachment_id = admin_coursemaker_courses.id AND system_files.attachment_type LIKE '%course'")];
		// json_encode($courses2['file_name']);


		// $a = $courses2['name'];
		// $b = $courses2['description'];

		// $result = array();
		// array_map(function ($c, $d) use (&$result) { array_push($result, $c, $d); }, $a, $b);
		// for($i = 0; $i<count($a); $i++)
		// {
		// 	$course1[] = $a[$i];

		// 	$course1[] = $b[$i];
			
		// }
		

		//  $course1 = array();

		// foreach ($courses2 as $course1)
		// {
		// 	$course1[] = $courses2;
		// 	$course1[] = $courses3;
		// 	$course1[] = $courses4;
			// $course1[] = $courses2['description'];
			// $course1[] = $courses2['file_name'];
		
			//var_dump($course1);
			// $course1[] = $courses2["name"] = json_encode([DB::select(
			// "SELECT admin_coursemaker_courses.name
			// FROM admin_coursemaker_courses")]);

			// $course1[] = $courses2["description"] = json_encode([DB::select(
			// "SELECT admin_coursemaker_courses.description
			// FROM admin_coursemaker_courses")]);

			// $course1[] = $courses2["file_name"] = json_encode([DB::select(
			// "SELECT system_files.file_name
			// FROM system_files, admin_coursemaker_courses
			// WHERE system_files.attachment_id = admin_coursemaker_courses.id AND system_files.attachment_type LIKE '%course'")]);

			//json_encode($course1);
			//$course1[] = $courses;
		// 	$course1['description']= $courses2['description'];
		// 	$course1['file_name'] = $courses2['file_name'];
		// 	$course1 = $course1['name'].$course1['description'].$course1['file_name'];
		
		 // }

		// $a = $courses2['name'];
		// $b = $courses2['description'];

		// for ($i =0; $i<count($a); $i++)
		// {
		// 	var_dump($a[$i]);
		// 	echo " ";
		// 	for ($j=$i; $j==$i; $j++)
		// 	{
		// 		var_dump($b[$j]);
		// 	}
		// 	echo "<br />";
		// }

		// $collection = array();
		// foreach($collection as $collection) {
		// 	$collection[] = $courses2;
		// }
		// print_r(call_user_func_array('array_merge_recursive'($collection), $collection));

		// $courses["all_courses"] = $courses2;

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
		


		$course["data"] = [
			DB::select("SELECT admin_coursemaker_lessons.name FROM admin_coursemaker_lessons WHERE admin_coursemaker_lessons.course_id = $id;"),
		];
		return response()-> json($course);


		/* mus ajar
		$course = 
			json_encode(DB::select("SELECT admin_coursemaker_lessons.name FROM admin_coursemaker_lessons WHERE admin_coursemaker_lessons.course_id = $id;"));

		var_dump($course);
		$course2["title"] = $course["name"];
		return response()-> json($course2);
		*/

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