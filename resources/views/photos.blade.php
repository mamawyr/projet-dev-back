@extends("template")


@section("content")

<div class="grid">
    @foreach ($photos as $p)
    <li><a href="/photo/{{ $p->id }}"><img src="{{ $p->url }}" alt=""></a></li>
    @endforeach
</div>
@endsection