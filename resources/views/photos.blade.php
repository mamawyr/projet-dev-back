@extends ('template')
@section ('content')

<div class="photo-div">
    @foreach ($photos as $p)
    <li class="photo"><img src="{{ $p->url }}" alt="" class="photo-apercu" data-photo-url="{{ $p->url }}" style="cursor: pointer;"></li>
    @endforeach
</div>

@endsection