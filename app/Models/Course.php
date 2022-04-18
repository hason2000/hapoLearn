<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'img_url',
        'price',
    ];

    public function getLearnerAttribute()
    {
        return self::users()->where('role', Config::get('course.role.user'))->count();
    }

    public function getLessonAttribute()
    {
        return self::lessons()->count();
    }

    public function getTimeAttribute()
    {
        return self::lessons()->sum('time');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'course_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_courses', 'course_id', 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'course_tags', 'course_id', 'tag_id');
    }

    public function scopeFilter($query, $data)
    {
        if (isset($data['created_time']) && !is_null($data['created_time'])) {
            $query->orderBy('created_at', $data['created_time']);
        } else {
            $query->orderBy('created_at', Config::get('course.sort.decrease'));
        }

        if (isset($data['keyword']) && !is_null($data['keyword'])) {
            $query->where('title', 'LIKE', '%' . $data['keyword'] . '%')
                ->orWhere('description', 'LIKE', '%' . $data['keyword'] . '%');
        }

        if (isset($data['sort_user']) && !is_null($data['sort_user'])) {
            $query->withCount([
                'users' => function ($subquery) {
                    $subquery->where('role', Config::get('course.role.user'));
                }
            ])->orderBy('users_count', $data['sort_user']);
        }

        if (isset($data['learn_time']) && !is_null($data['learn_time'])) {
            $query->withSum('lessons', 'time')->orderBy('lessons_sum_time', $data['learn_time']);
        }

        if (isset($data['sort_lesson']) && !is_null($data['sort_lesson'])) {
            $query->withCount('lessons')->orderBy('lessons_count', $data['sort_lesson']);
        }

        if (isset($data['tag']) && !is_null($data['tag'])) {
            $query->whereHas('tags', function ($subquery) use ($data) {
                $subquery->whereIn('tag_id', $data['tag']);
            });
        }

        if (isset($data['teacher']) && is_null($data['teacher'])) {
            $query->whereHas('users', function ($subquery) use ($data) {
                $subquery->where('user_id', $data['teacher']);
            });
        }
        
        return $query;
    }
}
