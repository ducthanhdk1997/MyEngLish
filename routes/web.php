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








Route::get('login', 'LoginController@getLogin')->name('getLogin');
ROute::post('login', 'LoginController@postLogin')->name('postLogin');
ROute::post('logout', 'LoginController@logout')->name('logout');
Route::get('home', 'HomeController@index');

// route admin
Route::get('Admin','HomeController@Admin');


Route::group(['prefix'=>'admin','middleware'=>'auth','as'=>'admin.'],function(){
    Route::group(['prefix'=>'grade','as'=>'grade.'],function (){
        Route::get('list','Admin\GradeController@getList')->name('list');
        Route::get('add','Admin\GradeController@add')->name('add');
        Route::post('add','Admin\GradeController@postGrade')->name('add');
        Route::get('{grade}/edit','Admin\GradeController@getGrade')->name('edit');
        Route::post('{grade}/edit','Admin\GradeController@setName')->name('edit');
    });



	Route::group(['prefix'=>'exercise','as'=>'exercise.'],function (){
	   Route::get('list','ExerciseController@getList')->name('list');
	   route::delete('{exercise}', 'ExerciseController@destroy')->name('delete');
	   Route::get('add','ExerciseController@create')->name('create');
	   Route::post('add','ExerciseController@store')->name('store');
	   Route::get('assign','ExerciseController@assign')->name('assign');
	   Route::post('assign','ExerciseController@postAssign')->name('assign');
	   Route::get('{exercise}/edit','ExerciseController@getExercise')->name('edit');
	   Route::post('{exercise}/edit','ExerciseController@setName')->name('update');
	   Route::get('{exercise}/detail','ExerciseController@show')->name('show');
    });

	Route::group(['prefix'=>'question','as'=>'question.'],function (){
	    Route::get('add','QuestrionController@create')->name('create');
        Route::post('add','QuestrionController@store')->name('store');
    });
    Route::group(['prefix'=>'classroom','as'=>'classroom.'],function (){
        Route::get('list','ClassRoomController@getList')->name('list');
        Route::get('add','ClassRoomController@add')->name('add');
    });

//    group ajax

    Route::group(['prefix'=>'ajax','as'=>'ajax.'],function (){
        Route::get('classtypetable/{grade_id}','Admin\AjaxController@getClassTypeTable')->name('classtypetable');
        Route::get('classtypeselect/{grade_id}','Admin\AjaxController@getClassTypeSelect')->name('classtypeselect');
        Route::get('coursetypetable/{grade_id}','Admin\AjaxController@getCourseTypeTable')->name('coursetypetable');
        Route::get('exercisetypeselect/{grade_id}','Admin\AjaxController@getExerciseTypeSelect')
                                                                                                    ->name('exercisetypeselect');
        Route::get('exercise/{grade_id}','Admin\AjaxController@getExercise')
                                                                                                    ->name('exercise');
        Route::get('coursetypeselect/{grade_id}','Admin\AjaxController@getCourseTypeSelect')
                                                                                                    ->name('coursetypeselect');

    });


});




Route::get('/home', 'HomeController@index')->name('home');

//Route::redirect('/', '');

Route::get('/', 'HomeController@index');


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function (){
    Auth::routes();
    Route::group(['middleware' => 'auth'], function(){
        Route::get('/', 'Admin\DashboardController@index')->name('index');

        Route::group(['prefix' => 'users', 'as' => 'users.'], function (){
            Route::get('/', 'Admin\UserController@index')->name('index');

            Route::get('{user}/detail', 'Admin\UserController@show')->name('detail');

            ROute::get('search', 'Admin\UserController@search')->name('search');

            Route::get('{user}/edit', 'Admin\UserController@edit')->name('edit');
            Route::put('{user}', 'Admin\UserCOntroller@update')->name('update');

            Route::get('create', 'Admin\UserController@create')->name('create');
            Route::post('create', 'Admin\UserController@store')->name('store');

            Route::delete('{user}', 'Admin\UserController@destroy')->name('delete');
        });

        Route::group(['prefix' => 'students', 'as' => 'students.'], function (){
            Route::get('/', 'Admin\StudentController@index')->name('index');

            Route::get('{user}/detail', 'Admin\StudentController@show')->name('detail');

            Route::get('{user}/edit', 'Admin\StudentController@edit')->name('edit');
            Route::put('{user}', 'Admin\StudentController@update')->name('update');

            Route::get('create', 'Admin\StudentController@create')->name('create');
            Route::post('create', 'Admin\StudentController@store')->name('store');

            Route::get('search', 'Admin\StudentController@search')->name('search');

            Route::delete('{user}', 'Admin\StudentController@destroy')->name('delete');
        });

        Route::group(['prefix' => 'courses', 'as' => 'courses.'], function(){
           Route::get('/', 'Admin\CourseController@index')->name('index');
           Route::get('create', 'Admin\CourseController@create')->name('create');
           Route::post('create', 'Admin\CourseController@store')->name('store');
           Route::get('{course}/edit', 'Admin\CourseController@edit')->name('edit');
           Route::put('{course}', 'Admin\CourseController@update')->name('update');
           Route::get('{course}/detail', 'Admin\CourseController@show')->name('show');
           route::delete('{course}', 'Admin\CourseController@destroy')->name('delete');
        });

        Route::group(['prefix' => 'classes', 'as' => 'classes.'], function (){
           Route::get('/', 'Admin\ClassController@index')->name('index');

            Route::get('create', 'Admin\ClassController@create')->name('create');
            Route::post('create', 'Admin\ClassController@store')->name('store');

            Route::get('{class}/edit', 'Admin\ClassController@edit')->name('edit');
            Route::put('{class}', 'Admin\ClassController@update')->name('update');

            Route::get('{class}/detail', 'Admin\ClassController@show')->name('show');

            route::delete('{class}', 'Admin\ClassController@destroy')->name('delete');
        });

        Route::group(['prefix' => 'exercises', 'as' => 'exercises.'], function (){
           Route::get('create', 'Admin\ExersiceController@create')->name('create');
           Route::post('create', 'Admin\ExersiceController@store')->name('store');
        });
    });
});

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix'=>'user','as'=>'user.'],function (){
    Route::get('{exercise}/exercise','ExerciseController@showforuser')->name('exercise');
    Route::post('{exercise}/exercise','ExerciseController@doExercise')->name('doexercise');
    Route::get('list',"ExerciseController@listForUser")->name('show');
    Route::get('done','ExerciseController@listExerHaveDone')->name('done');

});

