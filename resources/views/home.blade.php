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
                        {{ $image->user->name. ' '.$image->user->surname. ' | ' }} <span>{{ '@'.$image->user->nick }}</span>
                    </div>

                </div>
                <div class="card-body">
                    <div class="container-img">
                        <img src="{{ route('image.file', ['filename' => $image->image_path]) }}">
                    </div>
                    <div class="likes">
                        <img src="{{ asset('images/me-gustaNegro.png') }}">
                    </div>
                    <div class="container-desc">
                        <span>{{ '@'.$image->user->nick }}</span>
                        <p>{{ $image->description }}</p>
                    </div>

                    <a href="" class="btn btn-warning">
                        Coments ({{ count($image->comments) }})
                    </a>
                </div>
            </div>
            @endforeach

            <!-- Pagination -->
            {{ $images->links() }}

        </div>

    </div>
</div>
@endsection