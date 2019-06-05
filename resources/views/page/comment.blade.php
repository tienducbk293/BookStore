@if(isset($comments) || $comments != null)
    @foreach($comments as $key => $comment)
        <div class="display-comment">
            <div class="container">
                <div class="row">
                    <div class="comment-viewer">
                        <ul>
                            <?php
                                $date =  new DateTime($comment['date_create']['date']);
                                $now = new DateTime();
                                $diff = $date->diff($now);
                            ?>
                            <li><h5>{{ $comment['user_name'] }}</h5></li>
                            @if(0 < $diff->i && $diff->i <= 60)
                                @if(0 < $diff->h && $diff->h <= 24)
                                    @if(0 < $diff->d && $diff->d <= 30)
                                        @if(0 < $diff->m && $diff->m <= 12)
                                            @if($diff->y > 0)
                                                <li><span>{{ $diff->y }} năm trước</span></li>
                                            @else
                                                <li><span>{{ $diff->m }} tháng trước</span></li>
                                            @endif
                                        @else
                                            <li><span>{{ $diff->d }} ngày trước</span></li>
                                        @endif
                                    @else
                                        <li><span>{{ $diff->h }} giờ trước</span></li>
                                    @endif
                                @else
                                    <li><span>{{ $diff->i }} phút trước</span></li>
                                @endif
                            @else
                                <li><span>{{ $diff->i }} giây trước</span></li>
                            @endif
                        </ul>
                        <fieldset class="rate-display">
                            @for($i = 1; $i <= $comment['rating']; $i++)
                                <span class="fa fa-star checked"></span>
                            @endfor
                            @for($j = $comment['rating']+1; $j <=5; $j++)
                                <span class="fa fa-star un-checked"></span>
                            @endfor
                        </fieldset>
                        <p>{{ $comment['content'] }}</p>
                    </div>
                    @if($comment['user_name'] === session()->get('user_name'))
                        <!-- three dot menu -->
                        <div class="three-dots">
                            <!-- three dots -->
                            <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown()">
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <!-- menu -->
                            <div id="myDropdown" class="dropdown-content">
                                <a href="" id="editComment" data-toggle="tab" role="tab" data-content="{{ $key }}">Chỉnh sửa</a>
                                <a href="{{ route('deletecomment', $key) }}">Xóa</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            {{--<a class="reply-comment" onclick="replyBox()" href="#">Reply</a>--}}
            {{--<form method="post" action="{{ route('reply', $detail['book_id']) }}" id="reply" style="display: none">--}}
                {{--<input name="_token" type="hidden" value="{{csrf_token()}}" />--}}
                {{--<div class="form-group">--}}
                    {{--<input type="text" name="content" class="form-control" />--}}
                    {{--<input type="hidden" name="post_id" value="{{ $detail['book_id'] }}" />--}}
                    {{--<input type="hidden" name="parent_id" value="{{ $key }}" />--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<input type="submit" class="btn btn-info" value="Reply" />--}}
                    {{--<input type="submit" class="btn btn-danger drop" value="Drop" />--}}
                {{--</div>--}}
            {{--</form>--}}
        </div>
        <div class="edit-comment" style="display: none" id="{{ $key }}">
            <h5>{{ $comment['user_name'] }}</h5>
            <form action="{{ route('editcomment', @$comment['book_id']) }}" method="post">
                <fieldset class="rating">
                    <input type="radio" id="{{ $key }}-5"  name="rating" value="5" /><label class = "full" for="{{ $key }}-5" title="Awesome - 5 stars"></label>
                    <input type="radio" id="{{ $key }}-4" name="rating" value="4" /><label class = "full" for="{{ $key }}-4" title="Pretty good - 4 stars"></label>
                    <input type="radio" id="{{ $key }}-3" name="rating" value="3" /><label class = "full" for="{{ $key }}-3" title="Meh - 3 stars"></label>
                    <input type="radio" id="{{ $key }}-2" name="rating" value="2" /><label class = "full" for="{{ $key }}-2" title="Kinda bad - 2 stars"></label>
                    <input type="radio" id="{{ $key }}-1" name="rating" value="1" /><label class = "full" for="{{ $key }}-1" title="Sucks big time - 1 star"></label>
                </fieldset>
                <input name="_token" type="hidden" value="{{csrf_token()}}" />
                <div class="form-group">
                    <textarea name="comment" class="form-control">{{ $comment['content'] }}</textarea>
                    <input type="hidden" name="book_id" value="{{ @$comment['book_id'] }}">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Chỉnh sửa" id="submit">
                </div>
            </form>
        </div>
    @endforeach
@endif