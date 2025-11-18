<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Main extends Controller
{
    
    public function photos($id) {
        return "Affichage des photos de l'album ou de la photo d'id $id";
        }
}