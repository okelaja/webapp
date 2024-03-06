<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Kategori;
use App\Models\Buku;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // public function index() 
    // {
    //     $kategori = Kategori::all();
    //     $buku = Buku::all();
    //     return view('master.app', compact('buku','kategori'));

    // }
}   
