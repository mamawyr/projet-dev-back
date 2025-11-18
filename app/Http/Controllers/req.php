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
}