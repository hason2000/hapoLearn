<?php

namespace App\Http\Controllers;

use App\Models\UserCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class UserCourseController extends Controller
{
    public function store(Request $request)
    {
        UserCourse::create($request->all());
        return redirect()->route('courses.show', $request['course_id']);
    }

    public function update(Request $request, $courseId)
    {
        if (Auth::user()->isLearning($courseId)) {
            Auth::user()->courses()->updateExistingPivot($courseId, ['status' => Config::get('usercourse.learned_status')]);
            return redirect()->route('courses.show', $request['course_id']);
        } else {
            return redirect()->route('courses.show', $request['course_id']);
        }
    }
}
