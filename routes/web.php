<?php
use App\Http\Controllers\req;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $tags = DB::select("SELECT * FROM tags"); // Récupére les tags dans la base de données & à rajouter dans chaque vue
    $albums = DB::select("SELECT * FROM albums"); 
    return view('index', compact('tags', 'albums'));
    
});
Route::get('/album/{id}', [req::class, 'album'])->where ('id','[0-9]+');
Route::get('/photos/tag/{id}', [req::class, 'photosByTag'])->where('id','[0-9]+');
Route::get('/photos', [req::class, 'photos'])->where('id','[0-9]+');

Route::get('/search', [req::class, 'search']);

Route::post('/album/{id}/add-photo', [req::class, 'savephoto'])->where('id', '[0-9]+'); // Enregistrement de la photo dans la BDD

Route::post('/album/{album_id}/delete-photo', [req::class, 'deletephoto'])->where('album_id', '[0-9]+'); // Suppression de la photo dans la BDD