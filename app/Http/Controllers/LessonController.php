<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
	public function index()
	{
		$lessons["data"] = (
			DB::select("SELECT itrainasia_coursepad_lesson.title, itrainasia_coursepad_lesson.description FROM itrainasia_coursepad_lesson;")
		);
		return response()->json($lessons);
	}

	public function getLesson($id)
	{
		$lesson["title"] = 
			DB::select("SELECT itrainasia_coursepad_lesson.title 

				FROM itrainasia_coursepad_lesson

				WHERE itrainasia_coursepad_lesson.id = $id ;")
		;

		

		$lesson["videos"] = (
			DB::select("SELECT file_name, disk_name AS 'file_url'
				FROM system_files 
				WHERE attachment_type LIKE 'itrainasia%lesson'
				AND attachment_id = $id")
			);

		$lesson["content"] = (
			DB::select("SELECT itrainasia_coursepad_lesson.content
				FROM itrainasia_coursepad_lesson
				WHERE itrainasia_coursepad_lesson.id = $id ;")
		);
		// $lesson["data"] = DB::table('itrainasia_coursepad_lesson')
		// 					->join('system_files', function($join) {
		// 						$join->on('system_files.attachment_id', '=', $id)->orOn('system_files.attachment_type', 'like', 'itrainasia%lesson');
		// 					})
		// 					->select('itrainasia_coursepad_lesson.title', 'itrainasia_coursepad_lesson.content', 'a.file_name')
		// 					->get();

// 		$lesson_sel = array();
// for ($i = 0; $i < count($lesson["title"]); $i++) {
// 	$lesson_sel[] = $lesson["title"];
// 	$lesson_sel[] = $lesson["videos"];
// 	$lesson_sel[] = $lesson["content"];

// }

		return response()->json($lesson);
	}

	public function saveLesson(Request $request)
	{
		$lesson = Lesson::create($request->all());

		return response()->json($lesson);
	}

	public function deleteLesson($id)
	{
		$lesson = Lesson::find($id);

		$lesson->delete();

		return response()->json('success deleted');
	}

	public function updateLesson(Request $request, $id)
	{
		$lesson = Lesson::find($id);

		$lesson->name = $request->input('name');
		
		$lesson->save();

		return response()->json($lesson);
	}
}