<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';


    protected $fillable = [
        'username', 'email','address', 'password','gender', 'phone','facebook','level', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }
    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'user_class', 'user_id', 'class_id');
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'user_exam', 'user_id', 'exam_id')
            ->withPivot('exam_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'user_course', 'user_id', 'course_id');

    }

    public function examResult()
    {
        return $this->hasMany('App\Exam_Result', 'user_id');

    }

    public function testResult()
    {
        return $this->hasMany('App\ResultTest', 'user_id');
    }

    public function clas()
    {
        return $this->hasMany(Classes::class, 'teacher_id');
    }





}
