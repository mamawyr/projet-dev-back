<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Album Photos</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="{{asset('css/style.css') }}" rel="stylesheet">
        <!-- Styles -->
        
    </head>
    <body class="body">
    <main>
        <a href="/photos">photos</a>
        <h1>Album Photos</h1>


    <!-- J'initalise tags --> 
    @php 
        $tags = $tags ?? DB::table('tags')
        ->select('nom', DB::raw('MIN(id) as id'))
        ->groupBy('nom')
        ->get();

        $selected_tag = $selected_tag ?? null;
        $search = $search ?? "";
    @endphp

   <div class="menu_search">
        <form method="GET" action="/search" class="search-bar">
            <input type="text" name="v" placeholder="Votre recherche" value="{{ $search ?? '' }}">

            <select name="tag">
                <option value="">-- Tous les tags --</option>
                @foreach($tags as $t)
                    <option value="{{ $t->id }}" @if($selected_tag == $t->id) selected @endif>
                    {{ $t->nom }}
                </option>
                @endforeach
            </select>

            <button type="submit">Rechercher</button>
        </form>
    </div>
        

        @yield("content")
    </main>
    </body>
</html>
