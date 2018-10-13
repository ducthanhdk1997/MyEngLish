<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\ResPonse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Classes;

class HomeController extends Controller
{
    function __construct()
    {

    }

    public function Home()
    {
    	// // $class = DB::table('class')->get();
     //    $grade = DB::table('grades')->where('name','A1')->first();
     //    return view('myview',['class'=>$class]);
        $class = Classes::where('grade_id',1)
                        ->orderBy('name')
                        ->take(2)
                        ->get();
        return view('myview',['class'=>$class]);
    }

    public function GetUrl(request $request)
    {
    	return $request->url();
    	//is('admin*') kiem tra co tu admin trong request hay ko
    	//isMethod('post') kiem tra xem method co phai la post hay ko
    }

    public function postForm(Request $request)
    {
    	echo $request->hoten;
    }

    public function setCookie()
    {
    	$response = new ResPonse();
    	$response->withCookie('Test','MyEL',1);
    	return $response;
    }

    public function getCookie(Request $request)
    {
    	return $request->cookie('Test');
    }

    public function postFile(Request $request)
    {
    	if($request->hasFile('myfile'))
    	{
    		$file = $request->file('myfile');
    		$filename = $file->getClientOriginalName('myfile');
    		echo $filename;
    		//getClientOriginalExtension tra ve kieu cua file
    		$file->move('img',$filename);
    	}
    	else
    	{
    		echo "Chua co file";
    	}
    }

    public function getJson()
    {
    	$array = ['Name'=>'Thanh','Tuoi'=>21,'QueQuan'=>'BacNinh'];
    	return response()->json($array);
    }

    public function myView()
    {
    	$data=[
    		'BacNinh'=>'BacNinh'

    	];
    	return view('myview',$data);
    }

    public function blade($str)
    {
    	$khoahoc='DucThanh';
    	if($str =='laravel')
    	{
    		return view('pages.home',['khoahoc'=>$khoahoc]);
    	}
    	elseif ($str=="php") {
    		return view('pages.php',['khoahoc'=>$khoahoc]);
    	}
    }

    public function Admin()
    {
        return view('admin.layouts.index');
    }
}
