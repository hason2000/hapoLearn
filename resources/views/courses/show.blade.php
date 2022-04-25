@extends('layouts.app')

@section('content')
    <div class="course-detail">
        <div class="detail-link">Home > All courses > Course detail</div>
        <div class="detail-content d-flex">
            <div class="detail-left">
                <div class="detail-img">
                    <img class="w-100 h-100" src="{{ $course->img_url }}" alt="img of {{ $course->title }}">
                </div>
                <div class="detail-left-content">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="lesson-tab" data-toggle="tab" href="#lesson" role="tab" aria-controls="lesson" aria-selected="true">Lessons</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="teacher-tab" data-toggle="tab" href="#teacher" role="tab" aria-controls="teacher" aria-selected="false">Teacher</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="lesson" role="tabpanel" aria-labelledby="lesson-tab">
                            <div class="lesson-top d-flex align-item-center justify-content-between">
                                <form action="{{ route('courses.show', $course->id) }}" method="get">
                                    <input type="text" placeholder="Search..." name="keyword" @if (!is_null($request['keyword']))
                                        value="{{ $request['keyword'] }}"
                                    @endif>
                                    <i class="fa fa-search"></i>
                                    <button type="submit">Tìm kiếm</button>
                                </form>
                                @include('buttons.button_course')
                            </div>
                            <div class="lesson-content">
                                @forelse ($lessons as $key => $lesson)
                                    <div class="lesson-item d-flex align-item-center justify-content-between">
                                        <div class="lesson-item-text">
                                            @if (isset($request['page']) && !is_null($request['page']))
                                               <span class="lesson-stt">{{ Config::get('lesson.items_per_page') * 
                                                ($request['page'] - 1) + $key + 1 }}.</span>
                                            @else
                                                <span class="lesson-stt">{{ $key + 1 }}.</span>
                                            @endif
                                            <a href="{{ route('courses.lessons.show', [$course->id, $lesson->id]) }}" class="lesson-title">{{ $lesson->name }}</a>
                                        </div>
                                        <a href="{{ route('courses.lessons.show', [$course->id, $lesson->id]) }}" class="lesson-btn">
                                            {{ $lesson->isLearned() ? 'Learned' : 'Learn' }}
                                        </a>
                                    </div>
                                @empty
                                    <div class="py-5 text-center">
                                        <p class="text-notify">Không có bài học nào phù hợp!!!</p>
                                    </div>
                                @endforelse
                            </div>
                            <div class="lesson-pagination d-flex justify-content-end">
                                {{ $lessons->withQueryString()->links('layouts.pagination') }}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="teacher" role="tabpanel" aria-labelledby="teacher-tab">
                            <div class="teacher-content">
                                <div class="teacher-title">Main Teacher</div>
                                @foreach ($teachers as $teacher)
                                    <div class="teacher-item">
                                        <div class="item-top d-flex align-items-center">
                                            <div class="item-avata">
                                                <div class="avata-teacher-cus">
                                                    <img class="w-100 h-100" src="{{ $teacher->avata_url }}" alt="img of {{ $teacher->name }}">
                                                </div>
                                            </div>
                                            <div class="item-teacher-info">
                                                <div class="teacher-name">{{ $teacher->name }}</div>
                                                <span>Second Year Teacher</span>
                                                <div class="teacher-icon d-flex align-items-center">
                                                    <div class="icon-google">
                                                        <i class="fab fa-google-plus-g"></i>
                                                    </div>
                                                    <div class="icon-facebook">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad eaque non alias odit aliquid ut dignissimos numquam exercitationem porro eligendi corrupti facere earum, aperiam repellat qui. Aspernatur assumenda facere fugit.</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                            <div class="review-content">
                                <div class="review-total">
                                    05 Reviews
                                </div>
                                <div class="review-mid">
                                    <div class="review-left text-center">
                                        <div class="rating-number">5</div>
                                        <div class="rating-star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="rating-total">2 Ratings</div>
                                    </div>
                                    <div class="review-right">
                                        <div class="review-right-item d-flex align-items-center">
                                            <span>5 stars</span>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                                            </div>
                                            <span class="total-cmt">2</span>
                                        </div>
                                        <div class="review-right-item d-flex align-items-center">
                                            <span>4 stars</span>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 0"></div>
                                            </div>
                                            <span class="total-cmt">2</span>
                                        </div>
                                        <div class="review-right-item d-flex align-items-center">
                                            <span>3 stars</span>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 0"></div>
                                            </div>
                                            <span class="total-cmt">2</span>
                                        </div>
                                        <div class="review-right-item d-flex align-items-center">
                                            <span>2 stars</span>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 0"></div>
                                            </div>
                                            <span class="total-cmt">2</span>
                                        </div>
                                        <div class="review-right-item d-flex align-items-center">
                                            <span>1 stars</span>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 0"></div>
                                            </div>
                                            <span class="total-cmt">2</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="review-detail">
                                    <a href="" class="show-review">Show all reviews <i class="fas fa-angle-down"></i></a>
                                    <div class="review-detail-item">
                                        <div class="review-detail-top">
                                            <div class="avata-user-review">
                                                <img src="https://via.placeholder.com/640x480.png/00aa99?text=sed" alt="" class="w-100">
                                            </div>
                                            <div class="review-detail-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <span>August 4, 2020 at 1:30 pm</span>
                                        </div>
                                        <div class="review-detail-text">
                                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. At quos, excepturi velit quod saepe ipsum ipsam rerum quaerat, in sit, animi pariatur quo quas molestias modi eligendi qui vel aperiam!
                                        </div>
                                    </div>
                                </div>
                                <div class="add-review">
                                    <div class="add-review-title">Leave a Review</div>
                                    <span>Message</span>
                                    <form action="" method="post">
                                        <textarea name="" id="" cols="30" rows="10"></textarea>
                                        <div class="star-vote">
                                            <span class="star-vote-title">Vote</span>
                                            <div class="star-vote-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <span>(stars)</span>
                                        </div>
                                        <button type="submit" class="star-vote-btn">Send</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="detail-right">
                <div class="course-description">
                    <div class="description-title">
                        Descriptions course
                    </div>
                    <div class="description-detail">
                        {{ $course->description }}
                    </div>
                </div>
                <div class="course-info">
                    <div class="info-item info-learner d-flex align-items-center">
                        <i class="fa fa-users"></i>
                        <span class="info-text">Learners</span>
                        <span class="colon">:</span>
                        <span class="data">{{ $course->learner }}</span>
                    </div>
                    <div class="info-item info-lesson d-flex align-items-center">
                        <i class="fa fa-money-check"></i>
                        <span class="info-text text-lesson">Lessons</span>
                        <span class="colon">:</span>
                        <span class="data">{{ $course->lessons->count() }} lessons</span>
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
                </div>
                @include('courses.course_other')
            </div>
        </div>
    </div>
@endsection
