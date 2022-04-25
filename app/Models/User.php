<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phonenumber',
        'address',
        'date_of_birth',
        'username',
        'avata_url',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNameAttribute($name)
    {
        return strtoupper($name);
    }

    public function getUsernameAttribute($username)
    {
        return strtoupper($username);
    }

    public function getMakeAvataUrlAttribute()
    {
        return isset($this['avata_url']) ? $this['avata_url'] : asset('images/avata_default.png');
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'user_courses', 'user_id', 'course_id')->withPivot('status');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }
    
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'user_lessons', 'user_id', 'lesson_id');
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'user_documents', 'user_id', 'document_id');
    }

    public function isJoined($courseId)
    {
        $userCourse = UserCourse::where('user_id', Auth::id())->where('course_id', $courseId)->first();
        return (is_null($userCourse) ? false : true);
    }

    public function isLearning($courseId)
    {
        $userCourse = UserCourse::where('user_id', Auth::id())->where('course_id', $courseId)->first();
        return ($userCourse->status == Config::get('usercourse.learning_status') ? true : false);
    }

    public function scopeTeacher($query)
    {
        return $query->where('role', Config::get('course.role.teacher'));
    }
}
