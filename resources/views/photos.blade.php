@extends ('template')
@section ('content')

    @foreach ($photos as $p)
    <li><img src="{{ $p->url }}" alt="" class="photo-apercu" data-photo-url="{{ $p->url }}" style="cursor: pointer;"></li>
    @endforeach

@endsection