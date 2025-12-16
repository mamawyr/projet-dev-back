@extends ('template')
@section ('content')

<link rel="stylesheet" href="/css/photos.css">
<script src="/js/photos.js" defer></script>

<div class="photos-container">
    <h2>
        @if(isset($selected_tag) && $selected_tag)
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
    <div class="sort-controls tri">
        <form method="GET" class="sort-form">
            @if(!empty($search))
                <input type="hidden" name="v" value="{{ $search }}">
            @endif
            @if(isset($selected_tag) && $selected_tag)
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
                      <img src="{{ $p->url }}" alt="" class="photo-apercu" data-photo-url="{{ $p->url }}" style="cursor: pointer;">
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

<div id="photoModal" class="photo-modal" style="display: none;">
    <div class="modal-content">
        <span class="fermer">&times;</span>
        <img class="modal-image" src="" alt="">
    </div>
</div>

@endsection