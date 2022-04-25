@if (Auth::check() && Auth::user()->isJoined($course->id) && Auth::user()->isLearning($course->id))
    <form action="{{ route('users-courses.update', $course->id) }}" method="POST">
        @method('PUT')
        @csrf
        <input type="hidden" name="course_id" value="{{ $course->id }}">
        @if (Auth::check())
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        @endif
        <button type="submit" class="btn-join">Kết thúc khóa học</button>
    </form>
@elseif (Auth::check() && Auth::user()->isJoined($course->id) && !Auth::user()->isLearning($course->id))
    <button type="submit" class="btn-join btn-join-learned" disabled>Đã hoàn thành</button>
@else
    <form action="{{ route('users-courses.store') }}" method="post">
        @csrf
        <input type="hidden" name="course_id" value="{{ $course->id }}">
        @if (Auth::check())
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        @endif
        <button type="submit" class="btn-join">Tham gia khóa học</button>
    </form>
@endif
