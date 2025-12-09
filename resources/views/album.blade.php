@extends("template")


@section("content")

@php
    
@endphp

<link rel="stylesheet" href="/css/photos.css">
<script src="/js/photos.js" defer></script>

<!-- Formulaire d'ajout de photo -->
<form action="/album/{{ $album->id }}/add-photo" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Titre de l'image :</label><br>
    <input type="text" name="titre" required><br><br>

    <label>URL de l'image :</label><br>
    <input type="text" name="url"><br><br>

    <label>Ou insérer une image :</label><br>
    <input type="file" name="photo_file"><br><br>

    <button type="submit">Ajouter l'image</button>
</form>

<div class="grid">
    @foreach ($photos as $p)
    <li>
        <img src="{{ $p->url }}" alt="" class="photo-apercu" data-photo-url="{{ $p->url }}" style="cursor: pointer;">
        <h2>{{ $p->titre }} </h2>
        <p>Note : {{ $p->note }}/5</p>

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