<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class req extends Controller
{
        function photos() {
                $photos = DB::select("SELECT * FROM photos");  // Je récupère l ensemble des films
                return view("photos", ["photos" => $photos]);  // Je les donne à la vue
            }

        function albums() {
                $albums = DB::select("SELECT * FROM albums");  // Je récupère l ensemble des albums
                return view("index", ["albums" => $albums]);  // Je les donne à la vue
            }


        function search(Request $request) {

                $search = $request->input('v', ""); 
                $tag = $request->input('tag', null);

                $query = DB::table('photos')->select('photos.*'); //Accès à la base de données

                if (!empty($search)) {
                    $query->where('photos.titre','LIKE',"%$search%"); //Permet de filtre par le titre
                }

                if (!empty($tag)) {
                    $query->join('possede_tag', 'photos.id', '=', 'possede_tag.photo_id') //Permet de filtrer par tag
                        ->where('possede_tag.tag_id', $tag);
                }

                $photos = $query->distinct('photos.id')->get(); //Evite les doublons

                $tags = DB::table('tags') // Récupére les tags dans la base de données
                    ->select('id','nom')
                    ->distinct()
                    ->get();

                return view("photos", [
                    "photos" => $photos,
                    "tags" => $tags,
                    "selected_tag" => $tag,
                    "search" => $search
                ]);
            }
}