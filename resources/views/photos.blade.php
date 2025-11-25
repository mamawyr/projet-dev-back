

@extends("template")


@section("content")

@php
    $selected_tag = $selected_tag ?? null;
    $search = $search ?? "";
@endphp


<div class="grid">
    @foreach ($photos as $p)
    <li><a href="/photo/{{ $p->id }}"><img src="{{ $p->url }}" alt=""></a></li>
    @endforeach
</div>
@endsection