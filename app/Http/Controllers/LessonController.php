<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LessonController extends Controller
{
	public function index()
	{
		$lessons = Lesson::all();
		return response()->json($lessons);
	}

	public function getLesson($id)
	{
		$lesson = Lesson::find($id);
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