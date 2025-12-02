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
            $tags = DB::select("SELECT * FROM tags"); // Récupére les tags dans la base de données
            
                return view("album", ["photos" => $photos, "tags" => $tags]);  // Je les donne à la vue
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