<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class req extends Controller
{
        function photos() {
$selected_tag = $selected_tag ?? null;
        }

        function album($id) {
               // $albums = DB::select("SELECT * FROM albums");  // Je récupère l ensemble des albums
                   $search = $search ?? "";
            $photos = DB::table('photos')
        ->where('album_id', $id)
        ->get();
            
                return view("album", ["photos" => $photos]);  // Je les donne à la vue
            }

        function search(Request $request) {
            $search = $request->input('v');
            $tag = $request->input('tag');

            $query = DB::table('photos')->select('photos.*'); //Accès à la base de données

            if (!empty($search)) {
                $query->where('photos.titre','LIKE',"%$search%"); //Permet de filtre par le titre
            }

            if (!empty($tag)) {
                $query->join('possede_tag', 'photos.id', '=', 'possede_tag.photo_id')->where('possede_tag.tag_id', $tag); //Permet de filtrer par tag
            }

            $photos = $query->distinct('photos.id')->get(); //Evite les doublons
            $tags = DB::table('tags')->select('id','nom')->distinct()->get(); //Récupére les tags dans la base de données

            return view ("photos", [
                "photos" => $photos,
                "tags" => $tags,
                "selected_tag" => $tag,
                "search" => $search
                ]);
            }
}