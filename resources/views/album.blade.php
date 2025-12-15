@extends("template")


@section("content")

@php
    
@endphp

<link rel="stylesheet" href="/css/photos.css">
<script src="/js/photos.js" defer></script>

<h1>{{ $album->titre }}</h1>

<!-- Formulaire d'ajout de photo -->
<div class="sort-controls form">
    <form class="sort-form" action="/album/{{ $album->id }}/add-photo" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Titre de l'image :</label><br>
    <input type="text" name="titre" required><br><br>

    <label>URL de l'image :</label><br>
    <input type="text" name="url"><br><br>


    <label>Ou insérer une image :</label><br>
    <input type="file" name="photo_file"><br><br>

    <button type="submit">Ajouter l'image</button>
</form>

<!-- Contrôles de tri -->
<div class="sort-controls">
    <form method="GET" action="/album/{{ $album->id }}" class="sort-form">
        <label for="sort_photos">Trier par :</label>
        <select name="sort_photos" id="sort_photos" onchange="this.form.submit()">
            <option value="titre" @if($sortPhotos === 'titre') selected @endif>Titre</option>
            <option value="note" @if($sortPhotos === 'note') selected @endif>Note</option>
        </select>
        
        <label for="order_photos">Ordre :</label>
        <select name="order_photos" id="order_photos" onchange="this.form.submit()">
            <option value="asc" @if($orderPhotos === 'asc') selected @endif>Croissant</option>
            <option value="desc" @if($orderPhotos === 'desc') selected @endif>Décroissant</option>
        </select>
    </form>
</div>

<div class="photos-grid">
    @foreach ($photos as $p)
    <li class="photo-item">
        <img src="{{ $p->url }}" alt="" class="photo-apercu" data-photo-url="{{ $p->url }}" style="cursor: pointer;">
        <h2 class="photo-title">{{ $p->titre }} </h2>
        <p class="photo-note">Note : {{ $p->note }}/5</p>

</li>
    @endforeach
</div>

<div id="photoModal" class="photo-modal" style="display: none;">
    <div class="modal-content">
        <span class="fermer">&times;</span>
        <img class="modal-image" src="" alt="">
    </div>
</div>

<!-- Supprimer une photo -->
<h3>Supprimer une photo</h3>

<form action="/album/{{ $album->id }}/delete-photo" method="POST">
    @csrf

    <label>Choisissez une photo :</label>
    <select name="photo_id" required>
        <option value="">-- Choisir --</option>

        @foreach ($photos as $p)
            <option value="{{ $p->id }}">{{ $p->titre }}</option>
        @endforeach
    </select>

    <button type="submit" style="background:red; color:white;">Supprimer</button>
</form>



@endsection