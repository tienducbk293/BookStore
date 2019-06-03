@if(isset($comments))
    @foreach($comments as $key => $comment)
        <div class="display-comment" @if($comment['parent_id'] != null) style="margin-left:40px;" @endif>
            <h5>{{ $comment['user_name'] }}</h5>
            <fieldset class="rate-display">
                @for($i = 1; $i <= $comment['rate']; $i++)
                    <span class="fa fa-star checked"></span>
                @endfor
                @for($j = $comment['rate']+1; $j <=5; $j++)
                    <span class="fa fa-star un-checked"></span>
                @endfor
            </fieldset>
            <p>{{ $comment['content'] }}</p>
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
    @endforeach
@endif