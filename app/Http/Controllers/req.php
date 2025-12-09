<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class req extends Controller
{
        function photos() { 
            $selected_tag = $selected_tag ?? null;
            $photos = DB::select("SELECT * FROM photos"); // Je récupère l ensemble des photos
            $tags = DB::select("SELECT * FROM tags"); // Récupére les tags dans la base de données
                return view("photos", ["photos" => $photos, "tags" => $tags]);  // Je les donne à la vue
        }

        function photosByTag($id) {
                $photos = DB::table('photos')
                    ->join('possede_tag', 'photos.id', '=', 'possede_tag.photo_id')
                    ->where('possede_tag.tag_id', $id)
                    ->select('photos.*')
                    ->distinct('photos.id')
                    ->get();

                $tags = DB::select("SELECT * FROM tags");

                return view("photos", [
                    "photos" => $photos,
                    "tags" => $tags,
                    "selected_tag" => $id
                ]);
        }

        function album($id) {
               // $albums = DB::select("SELECT * FROM albums");  // Je récupère l ensemble des albums
               $album = DB::table('albums')->where('id', $id)->first();    
               $search = $search ?? "";
            $photos = DB::table('photos')
        ->where('album_id', $id)
        ->get();
            $tags = DB::select("SELECT * FROM tags"); // Récupére les tags dans la base de données
            
                return view("album", ["photos" => $photos, "tags" => $tags, "album" => $album]);  // Je les donne à la vue
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

            function addphoto($id) {
                $album = DB::table('albums')->where('id', $id)->first();

                if (!$album) {
                    abort(404); //Si pas d'album trouvée, erreur 404

                    return view('AjoutPhoto', ['album' => $album]);
                }
            }

            function savephoto(Request $request, $id)
            {
                $album = DB::table('albums')->where('id', $id)->first();
                if (!$album) abort(404);

                // Validation
                $request->validate([
                    'titre' => 'required|string|max:255',
                    'url' => 'nullable|url',
                    'photo_file' => 'nullable|image|max:2048', // 2 Mo max
                ]);

                $url = $request->input('url'); // URL si remplie

                // Si un fichier est uploadé, on le stocke et on remplace $url
                if ($request->hasFile('photo_file')) {
                    $path = $request->file('photo_file')->store('public/photos');
                    $url = Storage::url($path); // devient /storage/photos/xxx
                }

                // On n'insère que si une URL ou un fichier a été fourni
                if (!$url) {
                    return redirect("/album/$id")->with('erreur', 'Vous devez fournir une URL ou uploader une photo.');
                }

                // Insertion dans la BDD
                DB::table('photos')->insert([
                    'titre' => $request->input('titre'),
                    'url' => $url,
                    'album_id' => $id,
                ]);

                return redirect("/album/$id")->with('success', 'Photo ajoutée !');
            }

            function deletephoto(Request $request, $album_id)
{
                $photo_id = $request->input('photo_id');

                // Récupérer la photo
                $photo = DB::table('photos')->where('id', $photo_id)->first();

                if (!$photo) {
                    return redirect("/album/$album_id")->with('erreur', 'Photo introuvable');
                }

                // Supprimer fichier si uploadé
                if (substr($photo->url, 0, 8) == '/storage') {
                    $path = str_replace('/storage/', 'public/', $photo->url);
                    Storage::delete($path);
                }

                // Supprimer dans la BDD
                DB::table('photos')->where('id', $photo_id)->delete();

                return redirect("/album/$album_id")->with('success', 'Photo supprimée !');
        }
}