@extends ('template')
@section ('content')

<h1>Album Photos</h1>

<div class="albums-container">
    <h2>Albums</h2>
    
    <div class="sort-controls">
        <form method="GET" action="/" class="sort-form">
            <label for="sort_albums">Trier par :</label>
            <select name="sort_albums" id="sort_albums" onchange="this.form.submit()">
                <option value="titre" @if($sortAlbums === 'titre') selected @endif>Titre</option>
                <option value="creation" @if($sortAlbums === 'creation') selected @endif>Date de création</option>
            </select>
            
            <label for="order_albums">Ordre :</label>
            <select name="order_albums" id="order_albums" onchange="this.form.submit()">
                <option value="asc" @if($orderAlbums === 'asc') selected @endif>Croissant</option>
                <option value="desc" @if($orderAlbums === 'desc') selected @endif>Décroissant</option>
            </select>
        </form>
    </div>

    <ul class="albums-list">
        @foreach ($albums as $a)
            <li class="albums">
                <a href="/album/{{ $a->id }}">{{ $a->titre }}</a>
            </li>
        @endforeach
    </ul>
</div>

<style>
    .albums-container {
        padding: 20px;
    }

    .sort-controls {
        margin-bottom: 30px;
        background-color: #f5f5f5;
        padding: 15px;
        border-radius: 5px;
    }

    .sort-form {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .sort-form label {
        font-weight: bold;
    }

    .sort-form select {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        cursor: pointer;
    }

    .albums-list {
        list-style: none;
        padding: 0;
    }

    .albums {
        padding: 12px;
        margin-bottom: 8px;
        background-color: #f9f9f9;
        border-left: 4px solid #007bff;
        border-radius: 4px;
        transition: background-color 0.2s;
    }

    .albums:hover {
        background-color: #f0f0f0;
    }

    .albums a {
        text-decoration: none;
        color: #007bff;
        font-size: 1.1em;
    }

    .albums a:hover {
        text-decoration: underline;
    }
</style>

@endsection