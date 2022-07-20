@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif

            @foreach($images as $image)
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
                        <a href="{{ route('image.detail', ['id' => $image->id]) }}">
                        {{ $image->user->name. ' '.$image->user->surname. ' | ' }} <span>{{ '@'.$image->user->nick }}</span>
                        </a>
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
                        <img src="{{ asset('images/me-gustaRojo.png') }}" class="btn-like">
                        @else
                        <img src="{{ asset('images/me-gustaNegro.png') }}" class="btn-like">
                        @endif
                        
                    </div>
                    <div class="container-desc">
                        <span>{{ '@'.$image->user->nick }}</span>
                        <p>{{ $image->description }}</p>
                    </div>

                    <a href="" class="btn btn-warning">
                        Coments ({{ count($image->comments) }})
                    </a>

                    <div class="date">
                        <p>Published: <span>{{ FormatTime::LongTimeFilter($image->created_at)}} </span></p>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Pagination -->
            {{ $images->links() }}

        </div>

    </div>
</div>
@endsection