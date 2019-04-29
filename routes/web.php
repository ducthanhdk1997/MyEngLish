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
Route::post('login', 'LoginController@postLogin')->name('postLogin');
Route::get('logout', 'LoginController@logout')->name('logout');

// route admin
Route::get('/', 'LoginController@getLogin')->name('getLogin');

Route::get('home','HomeController@index')->name('index');

Route::group(['prefix' => 'student', 'as' => 'student.'],function (){
    Route::group(['prefix' => 'exma' , 'as' => 'exam.'], function (){
       Route::get('/','ExamController@index')->name('index');
       Route::get('create','ExamController@create')->name('create');
       Route::post('store','ExamController@stote')->name('store');
    });
});

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
        Route::get('coursetypeselect/{grade_id}','Admin\AjaxController@getCourseTypeSelect')
                                                                                                    ->name('coursetypeselect');
        Route::get('getroombyshiftandday/{day}/{shift}','Admin\AjaxController@getRoomByShiftAndDay')
                                                                                                ->name('getroombyshiftandday');
        Route::get('getdetailcourse/{course_id}','Admin\AjaxController@getDetailCourse')->name('getdetailcourse');

        Route::post('getclassroom','Admin\AjaxController@getClassroom')->name('getclassroom');

        Route::post('getusername','Admin\AjaxController@getUsername')->name('getusername');

        Route::post('checkvoucher','Admin\AjaxController@checkVoucher')->name('checkvoucher');

        Route::post('getprice','Admin\AjaxController@getPrice')->name('getprice');

    });


});



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
            Route::get('/','Admin\ExamController@index')->name('index');
            Route::get('{exam}/detail','Admin\ExamController@show')->name('show');
            Route::get('{exam}/edit','Admin\ExamController@edit')->name('edit');
            Route::put('{exam}','Admin\ExamController@update')->name('update');
            Route::get('create','Admin\ExamController@create')->name('create');
            Route::post('store','Admin\ExamController@store')->name('store');
        });

        Route::group(['prefix' => 'schedule', 'as' => 'schedule.'],function (){
            Route::get('index','Admin\ClassSessionController@index')->name('index');
            Route::get('{class}/create','Admin\ClassSessionController@create')->name('create') ;
            Route::post('{class}/store','Admin\ClassSessionController@store')->name('store') ;
            Route::get('edit/{schedule}','Admin\ClassSessionController@edit')->name('edit');
            Route::post('update/{schedule}','Admin\ClassSessionController@update')->name('update');
        });

        Route::group(['prefix' => 'user_course' , 'as' =>'user_course.'],function (){
           route::get('index','Admin\StudentCourseController@index')->name('index');
           route::post('store','Admin\StudentCourseController@store')->name('store');
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
            Route::get('{class}/schedule','Admin\ClassController@schedule')->name('schedule');
            Route::get('create', 'Admin\ClassController@create')->name('create');
            Route::post('create', 'Admin\ClassController@store')->name('store');
            Route::get('adduser','Admin\ClassController@addUser')->name('addUser');
            Route::post('storeuser','Admin\ClassController@storeUser')->name('storeuser');

            Route::get('{class}/edit', 'Admin\ClassController@edit')->name('edit');
            Route::put('{class}', 'Admin\ClassController@update')->name('update');
            Route::get('{course_id}','Admin\ClassController@showByCourses')->name('showByCourses');
            Route::get('{class}/detail', 'Admin\ClassController@show')->name('show');
            Route::post('{class}/import', 'Admin\ClassController@importStudent')->name('import');


        });


    });
});

//Route::get('/home', 'HomeController@index')->name('home');



