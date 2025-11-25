<!--
    Les photos appartiennent à un album. 
    Les photos ont également des étiquettes
    Il est possible de voir l'ensemble des albums => fonctionne
    Il est possible de voir les photos d'un album
    Lorsqu'on clique sur une photo, on la voit en grand (un peu de JS, ca ne fait pas de mal).
    Il doit être possible de filtrer les photos visualisées par rapport aux étiquettes ou à une recherche sur le titre
    Il doit être possible d'insérer une photo dans un album (d'abord via une url, ensuite via l'upload de photos) => fonctionne
    Il doit être possible de supprimer une photo d'un album (et donc la photo)
    Il doit être possible de trier l'affichage suivant les notes, les titres
    Il doit être possible de trier les albums par date de création ou par titre
-->

@extends ('template')
@section ('content')

 @php 
        $albums = $albums ?? DB::table('albums')
        ->select('titre', DB::raw('MIN(id) as id'))
        ->groupBy('titre')
        ->get();

    @endphp


@foreach ($albums as $a)
    <li><a href="/album/{{ $a->id }}">{{ $a->titre }}</a></li>
@endforeach


@endsection