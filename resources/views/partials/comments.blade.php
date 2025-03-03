@foreach ($post->comments as $comment)
    <div class="comment mb-4">
        <strong>{{ $comment->user->name }}</strong>
        <p>{{ $comment->content }}</p>
    </div>
@endforeach
