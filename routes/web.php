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

Route::get('/', function () {
    return view('welcome');
});
Route::get('MyEL', function(){
	return "xin chao cac ban";
});

//dinh danh cho route
Route::get('Route1',['as'=>'MyRoute',function(){
	echo "xin chao!";
}]);

Route::get('Route2',function(){
	echo "day la route 2";
})->name('MyRoute2');

Route::get('goiten',function(){
	return redirect()->route('MyRoute2');
});

Route::get('goi',function()
{
	return redirect()->route('MyRoute');
});

// group

Route::group(['prefix'=>'MyGroup'],function(){
	Route::get('User1',function(){
		return 'user1';
	});

	Route::get('User2',function(){
		return 'user2';
	});
});

// goi controller

Route::get('Home','HomeController@Home');

// url

Route::get('MyRequest','HomeController@GetUrl');

// gui nhan dulieu request

Route::get('getForm',function(){
	return view('postForm');
});

Route::post('postForm',['as'=>'postForm','uses'=>'HomeController@postForm']);

// cookie

Route::get('setCookie','HomeController@setCookie');
Route::get('getCookie','HomeController@getCookie');

// upload file

Route::get('uploadFile',function(){
	return view('postFile');
});

Route::post('postFile',['as'=>'postFile','uses'=>'HomeController@postFile']);

// tra du lieu kieu json

Route::get('getJson','HomeController@getJson');

// dung chung view

Route::get('myview','HomeController@myView');
View::share('DucThanh',"DucThanhat");

//blade template

Route::get('blade',function(){
	return view('pages.home');
});
Route::get('blade2',function(){
	return view('layouts.master');
});

Route::get('BladeTemplate/{str}','HomeController@blade');

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
    });
	Route::group(['prefix'=>'course'],function (){
        Route::get('list','CourseController@getList');
        Route::get('add','CourseController@add');
    });
	Route::group(['prefix'=>'exercise'],function (){
	   Route::get('list','ExerciseController@getList');
	   Route::get('add','ExerciseController@add');
	   Route::get('assign','ExerciseController@assign');
    });
});

