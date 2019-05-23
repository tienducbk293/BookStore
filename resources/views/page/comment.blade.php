@foreach($comments as $key => $comment)
    <div class="display-comment" id="content" @if($comment['parent_id'] != null) style="margin-left:40px;" @endif>
        <strong>{{ $comment['user_name'] }}</strong>
        <p>{{ $comment['content'] }}</p>
        <button class="btn btn-info" onclick="replyBox(this.value)" value=" {{ $key }}">Reply</button>
        <form method="post" action="{{ route('reply', $detail['book_id']) }}" id="reply" style="display: none">
            <input name="_token" type="hidden" value="{{csrf_token()}}" />
            <div class="form-group">
                <input type="text" name="content" class="form-control" />
                <input type="hidden" name="post_id" value="{{ $detail['book_id'] }}" />
                <input type="hidden" name="parent_id" value="{{ $key }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-info" value="Reply" />
                <input type="submit" class="btn btn-danger drop" value="Drop" />
            </div>
        </form>
    </div>
@endforeach