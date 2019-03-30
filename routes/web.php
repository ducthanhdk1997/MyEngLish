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

// route admin
Route::get('/', 'LoginController@getLogin')->name('getLogin');


Route::group(['prefix'=>'admin','middleware'=>'auth','as'=>'admin.'],function(){




    Route::group(['prefix'=>'classroom','as'=>'classroom.'],function (){
        Route::get('list','Admin\ClassRoomController@getList')->name('list');
        Route::get('add','Admin\ClassRoomController@add')->name('add');
    });

//    group ajax

    Route::group(['prefix'=>'ajax','as'=>'ajax.'],function (){
        Route::get('classtypetable/{course_id}','Admin\AjaxController@getClassTypeTable')->name('classtypetable');
        Route::get('classtypeselect/{course_id}','Admin\AjaxController@getClassTypeSelect')->name('classtypeselect');
        Route::get('coursetypetable/{grade_id}','Admin\AjaxController@getCourseTypeTable')->name('coursetypetable');
        Route::get('exercisetypeselect/{grade_id}','Admin\AjaxController@getExerciseTypeSelect')
                                                                                                    ->name('exercisetypeselect');
        Route::get('exercise/{grade_id}','Admin\AjaxController@getExercise')
                                                                                                    ->name('exercise');
        Route::get('coursetypeselect/{grade_id}','Admin\AjaxController@getCourseTypeSelect')
                                                                                                    ->name('coursetypeselect');

    });


});




//Route::get('/home', 'HomeController@index')->name('home');

//Route::redirect('/', '');

//Route::get('/', 'HomeController@index');


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function (){
    Auth::routes();
    Route::group(['middleware' => 'auth'], function(){
        Route::get('/', 'Admin\DashboardController@index')->name('index');

        Route::group(['prefix' => 'home', 'as' => 'home.'],function (){
            Route::get('/','Admin\HomeController@index')->name('index');

        });

        Route::group(['prefix' => 'note', 'as' =>'note.'], function (){
            Route::get('detail/{state}','Admin\NoteController@show')->name('show');
        });

        Route::group(['prefix' => 'exam', 'as' =>'exam.'], function (){
            Route::get('detail/{state}','Admin\ExamController@show')->name('show');
        });


        Route::group(['prefix' => 'teachers', 'as' => 'teachers.'], function (){
            Route::get('/', 'Admin\TeacherController@index')->name('index');

            Route::get('{teacher}/detail', 'Admin\TeacherController@show')->name('detail');

            ROute::get('search', 'Admin\TeacherController@search')->name('search');

            Route::get('{teacher}/edit', 'Admin\TeacherController@edit')->name('edit');
            Route::put('{teacher}', 'Admin\TeacherController@update')->name('update');

            Route::get('create', 'Admin\TeacherController@create')->name('create');
            Route::post('create', 'Admin\TeacherController@store')->name('store');

            Route::delete('{teachers}', 'Admin\TeacherController@destroy')->name('delete');
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
            Route::get('{course_id}','Admin\ClassController@showByCourses')->name('showByCourses');
            Route::get('{class}/detail', 'Admin\ClassController@show')->name('show');
            Route::post('{class}/import', 'Admin\ClassController@importStudent')->name('import');


        });


    });
});

//Route::get('/home', 'HomeController@index')->name('home');



