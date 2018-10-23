<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/






Route::get('setCookie','HomeController@setCookie');
Route::get('getCookie','HomeController@getCookie');

// upload file

Route::get('uploadFile',function(){
	return view('postFile');
});

Route::get('login',function (){
    return view('login');
});
Route::get('thanhcong',function(){
    return view('thanhcong');
});
Route::post('login','UserController@login');


//blade template


// create db



// route admin
Route::get('Admin','HomeController@Admin');


Route::group(['prefix'=>'admin'],function(){
	Route::group(['prefix'=>'class'],function(){
		Route::get('list','ClassController@getList');
		Route::get('add','ClassController@add');
		Route::get('adduser','ClassController@addUser');

	});
	Route::group(['prefix'=>'grade'],function (){
	    Route::get('list','GradeController@getList');
	    Route::get('add','GradeController@add');
        Route::post('add','GradeController@postGrade');
    });
	Route::group(['prefix'=>'course'],function (){
        Route::get('list','CourseController@getList');
        Route::get('add','CourseController@add');
    });
	Route::group(['prefix'=>'exercise'],function (){
	   Route::get('list','ExerciseController@getList');
	   Route::get('add','ExerciseController@add');
	   Route::get('assign','ExerciseController@assign');
	   Route::post('add','ExerciseController@postExercise');
    });
    Route::group(['prefix'=>'classroom'],function (){
        Route::get('list','ClassRoomController@getList');
        Route::get('add','ClassRoomController@add');

    });

//    group ajax

    Route::group(['prefix'=>'ajax'],function (){
        Route::get('class_type_table/{grade_id}','AjaxController@getClassTypeTable');
        Route::get('class_type_select/{grade_id}','AjaxController@getClassTypeSelect');
        Route::get('course_type_table/{grade_id}','AjaxController@getCourseTypeTable');
    });
});

