@extends('layouts.app')

@section('content')
    <div class="lesson-detail">
        <div class="detail-link">Home > All courses > Course detail > Lesson detail</div>
        <div class="detail-content d-flex">
            <div class="detail-left">
                <div class="detail-img">
                    <img class="w-100 h-100" src="{{ $course->img_url }}" alt="img of {{ $course->title }}">
                </div>
                <div class="progress mt-4">
                    <p class="number-progress">@if (is_null($userLesson)) 0 @else {{ $userLesson->progress }} @endif%</p>
                    <div class="progress-bar" role="progressbar" style="width:@if (is_null($userLesson)) 0% @else {{ $userLesson->progress }}% @endif;"></div>
                </div>
                <div class="detail-left-content">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Descriptions</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="doc-tab" data-toggle="tab" href="#doc" role="tab" aria-controls="doc" aria-selected="false">Documents</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews</a>
                          </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                            <div class="des-content">
                                <div class="des-title">
                                    Descriptions lesson
                                </div>
                                <div class="des-text">{{ $lesson->description }}</div>
                                <div class="reqire-title">Requirements</div>
                                <div class="require-text">{{ $lesson->description }}</div>
                                <div class="des-tag d-flex align-items-center">
                                    <div class="des-tag-title">Tag:</div>
                                    <div class="des-tag-content d-flex align-items-center">
                                        @foreach ($tags as $tag)
                                            <div class="des-tag-item">
                                                #{{ $tag->name }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="doc" role="tabpanel" aria-labelledby="doc-tab">
                            <div class="lesson-doc-content">
                                <div class="doc-title">Documents</div>
                                <div class="doc-content">
                                    @forelse ($documents as $document)
                                        <div class="doc-item d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <div class="doc-icon">
                                                    <img src="{{ asset('images/doc_img.png') }}" alt="icondoc">
                                                </div>
                                                <div class="doc-format">docx</div>
                                                <a class="doc-name" href="{{ $document->link }}">{{ $document->name }}</a>
                                            </div>
                                            <div class="d-flex">
                                                <a href="{{ $document->link }}" class="doc-btn mr-1">Preview</a>
                                                @if (Auth::check())
                                                    @forelse (Auth::user()->documents as $key => $documentGet)
                                                        @if ($documentGet->id == $document->id)
                                                            <button class="doc-btn btn-learned">Learned</button>
                                                            @break
                                                        @endif
                                                        @if ($key == count(Auth::user()->documents) - 1)
                                                            <form action="{{ route('users-documents.store') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                                                <input type="hidden" name="document_id" value="{{ $document->id }}">
                                                                <button type="submit" class="doc-btn">Learn</button>
                                                            </form>
                                                        @endif 
                                                    @empty
                                                        <form action="{{ route('users-documents.store') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                                            <input type="hidden" name="document_id" value="{{ $document->id }}">
                                                            <button type="submit" class="doc-btn">Learn</button>
                                                        </form>
                                                    @endforelse
                                                @else
                                                    <form action="{{ route('users-documents.store') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                                        <input type="hidden" name="document_id" value="{{ $document->id }}">
                                                        <button type="submit" class="doc-btn">Learn</button>
                                                    </form>
                                                @endif
                                                
                                                {{-- <button class="doc-btn btn-learned">Learned</button> --}}
                                            </div>
                                        </div>
                                    @empty
                                        <div>Không có bài học nào</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                            ....
                        </div>
                    </div>
                </div>  
            </div>
            <div class="detail-right">
                <div class="course-info">
                    <div class="info-item info-learner d-flex align-items-center">
                        <i class="far fa-desktop"></i>
                        <span class="info-text info-course">Course</span>
                        <span class="colon">:</span>
                        <span class="data">{{ $course->title }}</span>
                    </div>
                    <div class="info-item info-learner d-flex align-items-center">
                        <i class="fa fa-users"></i>
                        <span class="info-text">Learners</span>
                        <span class="colon">:</span>
                        <span class="data">{{ $course->learner }}</span>
                    </div>
                    <div class="info-item info-time d-flex align-items-center">
                        <i class="far fa-clock"></i>
                        <span class="info-text text-time">Times</span>
                        <span class="colon">:</span>
                        <span class="data">{{ $course->time }} hours</span>
                    </div>
                    <div class="info-item info-tag d-flex align-items-center">
                        <i class="far fa-key"></i>
                        <span class="info-text text-tag">Tags</span>
                        <span class="colon">:</span>
                        <span class="data">
                            @foreach ($tags as $tag)
                                <a href="{{ route('courses.index', ['tag[]' => $tag->id]) }}">{{ $tag->name }},</a>
                            @endforeach
                        </span>
                    </div>
                    <div class="info-item info-price d-flex align-items-center">
                        <i class="far fa-money-bill-alt"></i>
                        <span class="info-text text-price">Price</span>
                        <span class="colon">:</span>
                        @if ($course->price == 0)
                            <span class="data">Free</span>   
                        @else
                            <span class="data">{{ $course->price }} $</span>
                        @endif
                    </div>                
                    <div class="lesson-detail-btn text-center">
                        @if (Auth::check() && Auth::user()->isJoin($course->id) && Auth::user()->isLearning($course->id))
                            <form action="{{ route('users-courses.update', $course->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                @if (Auth::check())
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                @endif
                                <button type="submit" class="btn-join">Kết thúc khóa học</button>
                            </form>
                        @elseif (Auth::check() && Auth::user()->isJoin($course->id) && !Auth::user()->isLearning($course->id))
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
                    </div>
                </div>
                @include('courses.course_other')
            </div>
        </div>
    </div>
@endsection
