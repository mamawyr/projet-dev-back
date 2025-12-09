@extends ('template')
@section ('content')

<div class="photo-div">
    @foreach ($photos as $p)
    <li class="photo"><img src="{{ $p->url }}" alt="" class="photo-apercu" data-photo-url="{{ $p->url }}" style="cursor: pointer;"></li>
    @endforeach
</div>

<div class="photos-container">
    <h2>
        @if($selected_tag)
            Photos avec le tag: 
            @foreach($tags as $tag)
                @if($tag->id == $selected_tag)
                    {{ $tag->nom }}
                @endif
            @endforeach
        @else
            Résultats de recherche
        @endif
    </h2>

    <!-- Contrôles de tri -->
    <div class="sort-controls">
        <form method="GET" class="sort-form">
            @if(!empty($search))
                <input type="hidden" name="v" value="{{ $search }}">
            @endif
            @if($selected_tag)
                <input type="hidden" name="tag" value="{{ $selected_tag }}">
            @endif
            
            <label for="sort_photos">Trier par :</label>
            <select name="sort_photos" id="sort_photos" onchange="this.form.submit()">
                <option value="titre" @if(isset($sortPhotos) && $sortPhotos === 'titre') selected @endif>Titre</option>
                <option value="note" @if(isset($sortPhotos) && $sortPhotos === 'note') selected @endif>Note</option>
            </select>
            
            <label for="order_photos">Ordre :</label>
            <select name="order_photos" id="order_photos" onchange="this.form.submit()">
                <option value="asc" @if(isset($orderPhotos) && $orderPhotos === 'asc') selected @endif>Croissant</option>
                <option value="desc" @if(isset($orderPhotos) && $orderPhotos === 'desc') selected @endif>Décroissant</option>
            </select>
        </form>
    </div>

    @if(count($photos) > 0)
        <div class="photos-grid">
            @foreach($photos as $p)
                <div class="photo-item">
                    <img src="{{ $p->url }}" alt="{{ $p->titre }}" class="photo-apercu" data-photo-url="{{ $p->url }}" style="cursor: pointer;">
                    <p class="photo-title">{{ $p->titre }}</p>
                    @if($p->note)
                        <p class="photo-note">Note : {{ $p->note }}/5</p>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <p class="no-photos">Aucune photo trouvée pour cette recherche.</p>
    @endif

    <div class="back-link">
        <a href="/">← Retour à l'accueil</a>
    </div>
</div>

<style>
    .sort-controls {
        margin: 20px 0;
        background-color: #f5f5f5;
        padding: 15px;
        border-radius: 5px;
    }

    .sort-form {
        display: flex;
        gap: 20px;
        align-items: center;
        flex-wrap: wrap;
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

    .photos-container {
        padding: 20px;
    }

    .photos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .photo-item {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.2s;
    }

    .photo-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .photo-apercu {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
    }

    .photo-title {
        font-weight: bold;
        padding: 10px;
        margin: 0;
    }

    .photo-note {
        padding: 0 10px;
        font-size: 0.95em;
        color: #ff9800;
        margin: 5px 0;
        font-weight: bold;
    }

    .no-photos {
        text-align: center;
        color: #999;
        padding: 40px;
        font-size: 1.1em;
    }

    .back-link {
        margin-top: 30px;
    }

    .back-link a {
        color: #007bff;
        text-decoration: none;
        font-size: 1.1em;
    }

    .back-link a:hover {
        text-decoration: underline;
    }
</style>
>>>>>>> a46a09ed3bac9a3f531fb0261386e071cc169772

@endsection