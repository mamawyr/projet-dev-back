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
    return view('index', compact('tags'));
    
});
Route::get('/albums', [req::class, 'albums'])->where ('id','[0-9]+');;
Route::get('/photos', [req::class, 'photos'])->where('id','[0-9]+');;

Route::get('/search', [req::class, 'search']);