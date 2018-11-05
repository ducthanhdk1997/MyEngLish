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
Route::get("",function (){
  return View('welcome');
});

// upload file

Route::get('uploadFile',function(){
	return view('postFile');
});

Route::get('login',function (){
    return view('login');
});

Route::post('login','UserController@login');
Route::get('logout','UserController@logout');


//blade template


// create db



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
	Route::group(['prefix'=>'class','as'=>'class.'],function(){
		Route::get('list','Admin\ClassController@getList')->name('list');
		Route::get('add','Admin\ClassController@add')->name('add');
		Route::post('add','Admin\ClassController@postClass')->name('add');
		Route::get('adduser','Admin\ClassController@addUser')->name('adduser');
		Route::get('{class}/edit','Admin\ClassController@getClass')->name('edit');
		Route::post('{class}/edit','Admin\ClassController@setName')->name('update');
	});

	Route::group(['prefix'=>'course','as'=>'course.'],function (){
        Route::get('list','CourseController@getList')->name('list');
        Route::get('add','CourseController@add')->name('add');
    });
	Route::group(['prefix'=>'exercise','as'=>'exercise.'],function (){
	   Route::get('list','ExerciseController@getList')->name('list');
	   Route::get('add','ExerciseController@add')->name('add');
	   Route::post('add','ExerciseController@postExercise')->name('add');
	   Route::get('assign','ExerciseController@assign')->name('assign');
	   Route::post('assign','ExerciseController@postAssign')->name('assign');
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
        Route::get('exercisetypeselect/{grade_id}/{style_id}','Admin\AjaxController@getExerciseTypeSelect')
                                                                                                    ->name('exercisetypeselect');
        Route::get('exercisetypetable/{grade_id}/{style_id}','Admin\AjaxController@getExerciseTypeTable')
                                                                                                    ->name('exercisetypetable');

    });
});




Route::get('/home', 'HomeController@index')->name('home');

Route::redirect('/', 'admin');

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
    });
});

Route::get('/home', 'HomeController@index')->name('home');
