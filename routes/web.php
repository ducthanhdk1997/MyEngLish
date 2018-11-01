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


Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
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




Route::get('/home', 'HomeController@index')->name('home');

Route::redirect('/', 'admin');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function (){
    Auth::routes();
    Route::group(['middleware' => 'auth'], function(){
        Route::get('/', 'Admin\DashboardController@index')->name('index');
        Route::group(['prefix' => 'users', 'as' => 'users.'], function (){
            Route::get('/', 'Admin\UserController@index')->name('index');
            Route::get('{user}/edit', 'Admin\UserController@edit')->name('edit');
            Route::put('{user}', 'Admin\UserCOntroller@update')->name('update');
            Route::get('create', 'Admin\UserController@create')->name('create');
            Route::post('create', 'Admin\UserController@store')->name('store');
            Route::delete('{user}', 'Admin\UserController@destroy')->name('delete');
        });
    });
});

Route::get('/home', 'HomeController@index')->name('home');
