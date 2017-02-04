<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizController extends Controller
{
	public function index()
	{
		$quizzes = Quiz::all();
		return response()->json($quizzes);
	}

	public function getQuiz($id)
	{
		$quiz = Quiz::find($id);
		return response()-> json($quiz);
	}

	public function saveQuiz(Request $request)
	{
		$quiz = Quiz::create($request->all());

		return response()->json($quiz);
	}

	public function deleteQuiz($id)
	{
		$quiz = Quiz::find($id);

		$quiz->delete();

		return response()->json('success deleted');
	}

	public function updateQuiz(Request $request, $id)
	{
		$quiz = Quiz::find($id);

		$quiz->name = $request->input('name');
		
		$quiz->save();

		return response()->json($quiz);
	}
}