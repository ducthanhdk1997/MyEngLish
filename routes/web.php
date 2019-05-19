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

Route::get('/', 'LoginController@getLogin')->name('getLogin');
Route::get('login', 'LoginController@getLogin')->name('getLogin');
Route::post('postLogin', 'LoginController@postLogin')->name('postLogin');
Route::get('logout', 'LoginController@logout')->name('logout');



Auth::routes();
Route::group(['prefix' => 'password', 'as' => 'password.'], function (){
    Auth::routes();
    Route::get('getreset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('getreset');
    Route::post('email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('email');
//    Route::get('reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('token');
//    Route::post('reset', 'Auth\ResetPasswordController@reset');
});





Route::group(['middleware' => 'mymiddleware'], function (){
    Route::get('{user}/profile', 'UserController@profile')->name('profile');
    Route::post('{user}/update', 'UserController@update')->name('update');
    Route::group(['prefix' => 'notification', 'as' => 'notification.'],function (){
        Route::get('index','NotificatonController@index')->name('notification');
        Route::get('show/{notification}','NotificatonController@show')->name('show');
    });

});





Route::group(['prefix' => 'student', 'middleware' => 'student', 'as' => 'student.'],function (){
    Route::group(['prefix' => 'exam' , 'as' => 'exam.'], function (){
       Route::get('/','ExamController@index')->name('index');
       Route::get('create','ExamController@create')->name('create');
       Route::post('store','ExamController@stote')->name('store');
       Route::post('delete','ExamController@delete')->name('delete');
    });

    Route::group(['prefix' => 'class' , 'as' => 'class.'], function (){
        Route::get('/','ClassController@index')->name('index');
        Route::get('detail/{class}','ClassController@detail')->name('detail');
    });
});

Route::group(['prefix' => 'teacher','middleware' => 'teacher', 'as' => 'teacher.'],function (){
    Route::group(['prefix' => 'class', 'as' => 'class.'],function (){
        Route::get('/','Teacher\ClassController@index')->name('index');
        Route::get('detail/{class}','Teacher\ClassController@detail')->name('detail');
        Route::get('student_test/{class}','Teacher\ClassController@student_test')->name('student_test');
        Route::get('change_class_session','Teacher\ClassController@change_class_session')->name('change_class_session');
        Route::post('store_change_class_session/{teacher}','Teacher\ClassController@store_change_class_session')->name('store_change_class_session');
    });
    Route::group(['prefix' => 'test', 'as' => 'test.'], function (){
       Route::get('/','Teacher\TestController@index')->name('index');

       Route::get('{class}/create','Teacher\TestController@create')->name('create');
       Route::get('{class}/create_one','Teacher\TestController@create_one')->name('create_one');

       Route::post('store/{class}','Teacher\TestController@store')->name('store');

        Route::post('store_one/{class}','Teacher\TestController@store_one')->name('store_one');
       Route::get('export/{class_id}/{title}','Teacher\TestController@export')->name('export');
    });
});



Route::group(['prefix'=>'admin','middleware'=>'admin_and_employee','as'=>'admin.'],function(){

    Route::group(['prefix'=>'ajax','as'=>'ajax.'],function (){
        Route::get('classtypetable/{course_id}', 'Admin\AjaxController@getClassTypeTable')->name('classtypetable');
        Route::get('classtypeselect/{course_id}', 'Admin\AjaxController@getClassTypeSelect')->name('classtypeselect');
        Route::get('coursetypetable/{grade_id}', 'Admin\AjaxController@getCourseTypeTable')->name('coursetypetable');
        Route::get('coursetypeselect/{grade_id}', 'Admin\AjaxController@getCourseTypeSelect')
            ->name('coursetypeselect');
        Route::get('getroombyshiftandday/{day}/{shift}', 'Admin\AjaxController@getRoomByShiftAndDay')
            ->name('getroombyshiftandday');
        Route::get('getdetailcourse/{course_id}', 'Admin\AjaxController@getDetailCourse')->name('getdetailcourse');

        Route::post('getclassroom', 'Admin\AjaxController@getClassroom')->name('getclassroom');

        Route::post('getstudent', 'Admin\AjaxController@getStudents')->name('getstudent');

        Route::post('getusername', 'Admin\AjaxController@getUsername')->name('getusername');

        Route::post('checkvoucher', 'Admin\AjaxController@checkVoucher')->name('checkvoucher');

        Route::post('getprice', 'Admin\AjaxController@getPrice')->name('getprice');

        Route::get('getExam/{course}', 'Admin\AjaxController@getExam')->name('getExam');

        Route::get('getExamResult/{exam}', 'Admin\AjaxController@getExamResult')->name('getExamResult');

        Route::get('checkchange/{change_id}', 'Admin\AjaxController@checkChangeClassSession')->name('checkchange');

    });
});



Route::group(['prefix' => 'employee', 'as' => 'employee.'], function (){
    Auth::routes();
    Route::group(['middleware' => 'employee'], function(){
        Route::get('/', 'Admin\DashboardController@index')->name('index');

        Route::group(['prefix' => 'home', 'as' => 'home.'],function (){
            Route::get('/','Admin\HomeController@index')->name('index');

        });



        Route::group(['prefix'=>'classroom','as'=>'classroom.'],function (){
            Route::get('index','Admin\ClassRoomController@index')->name('index');
        });

        Route::group(['prefix' => 'requires', 'as' => 'requires.'],function (){
            Route::get('/','Admin\ChangeClassSession@index')->name('index');
            Route::get('update/{change_class_session}','Admin\ChangeClassSession@update')->name('update');
            Route::get('cancel/{change_class_session}','Admin\ChangeClassSession@cancel')->name('cancel');

        });

        Route::group(['prefix' => 'exam', 'as' =>'exam.'], function (){
            Route::get('/','Admin\ExamController@index')->name('index');
            Route::get('{exam}/detail','Admin\ExamController@show')->name('show');
            Route::get('create_result','Admin\ExamController@createResult')->name('create_result');
            Route::post('storeResult','Admin\ExamController@storeResult')->name('storeResult');
            Route::get('export/{exam}','Admin\ExamController@exportExcel')->name('export');
            Route::get('result','Admin\ExamController@result')->name('result');
            Route::get('showResult/{course}/{exam}','Admin\ExamController@showResult')->name('showResult');
            Route::get('updateState/{exam}','Admin\ExamController@updateState')->name('updateState');
            Route::get('arrange','Admin\ExamController@arrange')
                ->name('arrange');

            Route::get('arrange_by_course/{filCourse}','Admin\ExamController@arrangeByCourse')
                ->name('arrange_by_course');

            Route::get('exprortUserExam/{exam}','Admin\ExamController@exportUserExamExcel')->name('exprortUserExam');

            Route::post('arrange_student','Admin\ExamController@arrangeStudent')->name('arrange_student');


        });

        Route::group(['prefix' => 'schedule', 'as' => 'schedule.'],function (){
            Route::get('index','Admin\ClassSessionController@index')->name('index');
            Route::get('{class}/create','Admin\ClassSessionController@create')->name('create') ;
            Route::post('{class}/store','Admin\ClassSessionController@store')->name('store') ;
            Route::get('edit/{schedule}','Admin\ClassSessionController@edit')->name('edit');
            Route::post('update/{schedule}','Admin\ClassSessionController@update')->name('update');
            Route::get('updateState/{class_session}','Admin\ClassSessionController@updateState')->name('updateState');
        });

        Route::group(['prefix' => 'user_course' , 'as' =>'user_course.'],function (){
           route::get('index','Admin\StudentCourseController@index')->name('index');
           route::post('store','Admin\StudentCourseController@store')->name('store');
           route::get('bill/{user_course}','Admin\StudentCourseController@buil')->name('bill');
        });




        Route::group(['prefix' => 'students', 'as' => 'students.'], function (){
            Route::get('/', 'Admin\StudentController@index')->name('index');
            Route::put('{user}', 'Admin\StudentController@update')->name('update');

            Route::get('create', 'Admin\StudentController@create')->name('create');
            Route::post('create', 'Admin\StudentController@store')->name('store');
            Route::delete('{user}', 'Admin\StudentController@destroy')->name('delete');
        });

        Route::group(['prefix' => 'courses', 'as' => 'courses.'], function(){
           Route::get('/', 'Admin\CourseController@index')->name('index');
           Route::get('{course}/detail', 'Admin\CourseController@show')->name('show');
           Route::delete('{course}', 'Admin\CourseController@destroy')->name('delete');
           Route::get('detail','Admin\StudentCourseController@detail')->name('detail');
            Route::get('detail_by_quarter','Admin\StudentCourseController@detailByquater')->name('detail_by_quarter');

        });

        Route::group(['prefix' => 'classes', 'as' => 'classes.'], function (){
            Route::get('/', 'Admin\ClassController@index')->name('index');
            Route::get('{class}/schedule','Admin\ClassController@schedule')->name('schedule');
            Route::get('adduser','Admin\ClassController@addUser')->name('addUser');
            Route::post('storeuser','Admin\ClassController@storeUser')->name('storeuser');
            Route::get('{course_id}','Admin\ClassController@showByCourses')->name('showByCourses');
            Route::get('{class}/detail', 'Admin\ClassController@show')->name('show');
            Route::post('{class}/import', 'Admin\ClassController@importStudent')->name('import');
            Route::get('update_state/{class}', 'Admin\ClassController@update_state')->name('update_state');


        });


    });
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function (){
    Auth::routes();
    Route::group(['middleware' => 'admin_and_employee'], function(){
        Route::get('/', 'Admin\DashboardController@index')->name('index');

        Route::group(['prefix' => 'home', 'as' => 'home.'],function (){
            Route::get('/','Admin\HomeController@index')->name('index');

        });

        Route::group(['prefix' => 'voucher', 'middleware' => 'admin', 'as' => 'voucher.'], function (){
            Route::get('/','Admin\VoucherController@index')->name('index');
            Route::get('create','Admin\VoucherController@create')->name('create');
            Route::post('store','Admin\VoucherController@store')->name('store');
            Route::get('update/{voucher}','Admin\VoucherController@update')->name('update');
            Route::post('updateDetailVoucher/{voucher}','Admin\VoucherController@updateDetailVoucher')->name('updateDetailVoucher');
        });

        Route::group(['prefix'=>'classroom','as'=>'classroom.'],function (){
            Route::get('index','Admin\ClassRoomController@index')->name('index');
            Route::get('create','Admin\ClassRoomController@create')->name('create');
            Route::post('store','Admin\ClassRoomController@store')->name('store');
            Route::get('edit/{classroom}','Admin\ClassRoomController@edit')->name('edit');
            Route::post('update/{classroom}','Admin\ClassRoomController@update')->name('update');
        });

        Route::group(['prefix' => 'requires', 'as' => 'requires.'],function (){
            Route::get('/','Admin\ChangeClassSession@index')->name('index');
            Route::get('update/{change_class_session}','Admin\ChangeClassSession@update')->name('update');
            Route::get('cancel/{change_class_session}','Admin\ChangeClassSession@cancel')->name('cancel');

        });

        Route::group(['prefix' => 'exam', 'as' =>'exam.'], function (){
            Route::get('/','Admin\ExamController@index')->name('index');
            Route::get('{exam}/detail','Admin\ExamController@show')->name('show');
            Route::get('{exam}/edit','Admin\ExamController@edit')->name('edit');
            Route::put('{exam}','Admin\ExamController@update')->name('update');
            Route::get('create','Admin\ExamController@create')->name('create');
            Route::post('store','Admin\ExamController@store')->name('store');
            Route::get('create_result','Admin\ExamController@createResult')->name('create_result');
            Route::post('storeResult','Admin\ExamController@storeResult')->name('storeResult');
            Route::get('export/{exam}','Admin\ExamController@exportExcel')->name('export');
            Route::get('result','Admin\ExamController@result')->name('result');
            Route::get('showResult/{course}/{exam}','Admin\ExamController@showResult')->name('showResult');
            Route::get('updateState/{exam}','Admin\ExamController@updateState')->name('updateState');
            Route::get('arrange','Admin\ExamController@arrange')
                ->name('arrange');

            Route::get('arrange_by_course/{filCourse}','Admin\ExamController@arrangeByCourse')
                ->name('arrange_by_course');

            Route::get('exprortUserExam/{exam}','Admin\ExamController@exportUserExamExcel')->name('exprortUserExam');

            Route::post('arrange_student','Admin\ExamController@arrangeStudent')->name('arrange_student');


        });

        Route::group(['prefix' => 'schedule', 'as' => 'schedule.'],function (){
            Route::get('index','Admin\ClassSessionController@index')->name('index');
            Route::get('{class}/create','Admin\ClassSessionController@create')->name('create') ;
            Route::post('{class}/store','Admin\ClassSessionController@store')->name('store') ;
            Route::get('edit/{schedule}','Admin\ClassSessionController@edit')->name('edit');
            Route::post('update/{schedule}','Admin\ClassSessionController@update')->name('update');
            Route::get('updateState/{class_session}','Admin\ClassSessionController@updateState')->name('updateState');
        });

        Route::group(['prefix' => 'user_course' , 'as' =>'user_course.'],function (){
            route::get('index','Admin\StudentCourseController@index')->name('index');
            route::post('store','Admin\StudentCourseController@store')->name('store');
            route::get('bill/{user_course}','Admin\StudentCourseController@buil')->name('bill');
        });


        Route::group(['prefix' => 'teachers', 'as' => 'teachers.'], function (){
            Route::get('/', 'Admin\TeacherController@index')->name('index');

            Route::get('{teacher}/edit', 'Admin\TeacherController@edit')->name('edit');
            Route::put('{teacher}', 'Admin\TeacherController@update')->name('update');

            Route::get('create', 'Admin\TeacherController@create')->name('create');
            Route::post('create', 'Admin\TeacherController@store')->name('store');

            Route::delete('{teachers}', 'Admin\TeacherController@destroy')->name('delete');
        });

        Route::group(['prefix' => 'employee', 'as' => 'employee.'], function (){
            Route::get('/', 'Admin\EmployeeController@index')->name('index');
            Route::get('create', 'Admin\EmployeeController@create')->name('create');
            Route::post('create', 'Admin\EmployeeController@store')->name('store');
            Route::delete('{employee}', 'Admin\EmployeeController@destroy')->name('delete');
        });

        Route::group(['prefix' => 'students', 'as' => 'students.'], function (){
            Route::get('/', 'Admin\StudentController@index')->name('index');
            Route::put('{user}', 'Admin\StudentController@update')->name('update');

            Route::get('create', 'Admin\StudentController@create')->name('create');
            Route::post('create', 'Admin\StudentController@store')->name('store');
            Route::delete('{user}', 'Admin\StudentController@destroy')->name('delete');
        });

        Route::group(['prefix' => 'courses', 'as' => 'courses.'], function(){
            Route::get('/', 'Admin\CourseController@index')->name('index');
            Route::get('create', 'Admin\CourseController@create')->name('create');
            Route::post('create', 'Admin\CourseController@store')->name('store');
            Route::get('{course}/edit', 'Admin\CourseController@edit')->name('edit');
            Route::put('{course}', 'Admin\CourseController@update')->name('update');
            Route::get('{course}/detail', 'Admin\CourseController@show')->name('show');
            Route::delete('{course}', 'Admin\CourseController@destroy')->name('delete');
            Route::get('detail','Admin\StudentCourseController@detail')->name('detail');
            Route::get('detail_by_quarter','Admin\StudentCourseController@detailByquater')->name('detail_by_quarter');

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




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
