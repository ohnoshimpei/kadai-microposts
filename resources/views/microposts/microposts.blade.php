<ul class="list-unstyled">
    @foreach ($microposts as $micropost)
        <li class="media mb-3">
            <img class="mr-2 rounded" src="{{ Gravatar::src($micropost->user->email, 50) }}" alt="">
            <div class="media-body">
                <div>
                    {!! link_to_route('users.show', $micropost->user->name, ['id' => $micropost->user->id]) !!} <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                </div>
                <div>
                    <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                </div>
                <div>
                    @if (Auth::id() == $micropost->user_id)
                        {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    @endif   
                        
                    @if (Auth::user()->is_favorite($micropost->id))
                        {!! Form::open(['route' => ['microposts.unfavorite', $micropost->id], 'method' => 'delete']) !!}
                            {!! Form::submit('Unfavorite', ['class' => "btn btn-danger btn-block"]) !!}
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['route' => ['microposts.favorite', $micropost->id]]) !!}
                            {!! Form::submit('favorite', ['class' => "btn btn-primary btn-block"]) !!}
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{ $microposts->links('pagination::bootstrap-4') }}