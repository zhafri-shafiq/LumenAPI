<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->get('api/course', 'CourseController@index');

$app->get('api/course/{id}', 'CourseController@getCourse');

$app->post('api/course', 'CourseController@saveCourse');

$app->put('api/course/{id}', 'CourseController@updateCourse');

$app->delete('api/course/{id}', 'CourseController@deleteCourse');







$app->get('api/lesson', 'LessonController@index');

$app->get('api/lesson/{id}', 'LessonController@getLesson');

$app->post('api/lesson', 'LessonController@saveLesson');

$app->put('api/lesson/{id}', 'LessonController@updateLesson');

$app->delete('api/lesson/{id}', 'LessonController@deleteLesson');



$app->get('api/quiz', 'QuizController@index');

$app->get('api/quiz/{id}', 'QuizController@getQuiz');

$app->post('api/quiz', 'QuizController@saveQuiz');

$app->put('api/quiz/{id}', 'QuizController@updateQuiz');

$app->delete('api/quiz/{id}', 'QuizController@deleteQuiz');