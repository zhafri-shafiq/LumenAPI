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
			DB::select("SELECT admin_coursemaker_lessons.name FROM admin_coursemaker_lessons;")
		);
		return response()->json($lessons);
	}

	public function getLesson($id)
	{
		$lesson["data"] = (
			DB::select("SELECT admin_coursemaker_lessons.name, a.file_name AS 'image', b.file_name AS 'video' 

				FROM admin_coursemaker_lessons, system_files a, system_files b

				WHERE admin_coursemaker_lessons.id = $id AND a.attachment_id = $id AND a.attachment_type LIKE '%lesson' AND b.attachment_id = $id AND b.attachment_type LIKE '%lesson' AND a.content_type LIKE 'image%' AND b.content_type LIKE 'video%';")
		);
		return response()-> json($lesson);
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