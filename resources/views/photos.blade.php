

@extends("template")


@section("content")

@php
    $selected_tag = $selected_tag ?? null;
    $search = $search ?? "";
@endphp

<link rel="stylesheet" href="/css/photos.css">
<script src="/js/photos.js" defer></script>
<div class="grid">
    @foreach ($photos as $p)
    <li><a href="/photo/{{ $p->id }}"><img src="{{ $p->url }}" alt="" class="photo-apercu" data-photo-url="{{ $p->url }}" style="cursor: pointer;"></a></li>
    @endforeach
</div>

<div id="photoModal" class="photo-modal" style="display: none;">
    <div class="modal-content">
        <span class="fermer">&times;</span>
        <img class="modal-image" src="" alt="">
    </div>
</div>
    

@endsection