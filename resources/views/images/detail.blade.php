@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif


            <div class="card pub_img">
                <div class="card-header">
                    @if(isset($image->user->img))
                    <div class="card-body">
                        <div class="container-avatar-profile">
                            <img src="{{ route('user.avatar', ['filename'=> $image->user->img]) }}" class="avatar" />
                        </div>
                    </div>
                    @endif
                    <div class="data-user">
                        {{ $image->user->name. ' '.$image->user->surname. ' | ' }} <span>{{ '@'.$image->user->nick }}</span>
                    </div>

                </div>
                <div class="card-body">
                    <div class="container-img">
                        <img src="{{ route('image.file', ['filename' => $image->image_path]) }}">
                    </div>
                    <div class="likes">
                        {{count($image->likes)}}

                        <?php $user_like = false; ?>

                        @foreach($image->likes as $like)
                            @if($like->user->id == Auth::user()->id)
                                <?php $user_like = true; ?>
                            @endif
                        @endforeach
                        

                        @if($user_like)
                        <img src="{{ asset('images/me-gustaRojo.png') }}" data-id="{{$image->id}}" class="btn-like">
                        @else
                        <img src="{{ asset('images/me-gustaNegro.png') }}" data-id="{{$image->id}}" class="btn-dislike">
                        @endif
                        
                    </div>
                    <div class="container-desc">
                        <span>{{ '@'.$image->user->nick }}</span>
                        <p>{{ $image->description }}</p>
                    </div>
                    <div class="date">
                        <p>Published: <span>{{ FormatTime::LongTimeFilter($image->created_at)}} </span></p>
                    </div>

                    <h2>
                        Coments ({{ count($image->comments) }})
                    </h2>
                    <hr>

                    <div>
                        <form action="{{ route('coment.save')}}" method="post">
                            <!-- @csrf protección contra ataques de formulario -->
                            @csrf
                            <input type="hidden" name="image_id" id="image_id" value="{{ $image->id}}">

                            <p> Coment:
                                <textarea name="coment" id="coment" class="form-control"></textarea>
                            </p>


                            <button type="submit" class="btn btn-info">Post comment</button>
                        </form>

                        @error('image_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>Error</strong>
                        </span>
                        @enderror


                        @error('coment')
                        <span class="invalid-feedback" role="alert">
                            <strong>Error</strong>
                        </span>
                        @enderror
                        <br>
                        @foreach($image->comments as $comment)
                        <div class="commentslist">
                            <span>{{ '@'.$comment->user->nick }}</span> | <span>{{ FormatTime::LongTimeFilter($comment->created_at)}} </span>
                            <p>{{ $comment->content }} <br>
                                @if( Auth::check() && ($comment->user_id == Auth::user()->id || $comment->images->id == Auth::user()->id))
                                <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                            
                            @endif
                            </p>
                        </div>


                        @endforeach
                    </div>




                </div>
            </div>
        </div>

    </div>
</div>
@endsection