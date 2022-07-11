@if(Auth::user()->img)
<div class="container-avatar">
    <img src="{{ route('user.avatar', ['filename'=> Auth::user()->img]) }}" class="avatar"/>
</div>
@endif