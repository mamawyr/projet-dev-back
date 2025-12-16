@extends ('template')
@section ('content')

<h1>Album Photos</h1>

<div class="albums-container">
    <h2>Albums</h2>
    
    <div class="sort-controls tri">
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


@endsection