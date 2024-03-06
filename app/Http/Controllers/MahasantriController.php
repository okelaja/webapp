<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasantriController extends Controller
{
    //bikin fungsi
    public function index(Request $request) 
    {
        $cari = $request->get('cari');
        // return "Apa-apa";
        $mahasantri  = [
            [
                "id" => "1",
                "nama" => "Samsul"

            ],
            [
                "id" => "2",
                "nama" => "Asep"

            ],
            [
                "id" => "3",
                "nama" => "Bopak"

            ],
        ];
        // view adalah file yang di tuju            data compact adalah data yang akan di kirimkan 
                                                  //compact harus sama seperti variabel yang di dalam function
        return view('mahasantri/index',compact('mahasantri','cari'));
    }
    
    public function getid($id)
    {
        #nama variabel dan compact harus sama jangan ada yang beda kalo beda tak pukul 
        $idd = $id; 

        $users = [
            [
                'id' => 1,
                'nama' => 'Samsul'
            ],
            [
                'id' => 2,
                'nama' => 'Asep'
            ],
            [
                'id' => 3,
                'nama' => 'Bopak'
            ],
            [
                'id' => 4,
                'nama' => 'Bambang'
            ],
            [
                'id' => 5,
                'nama' => 'Agung'
            ],
            [
                'id' => 6,
                'nama' => 'Santugil'
            ],
            [
                'id' => 7,
                'nama' => 'Yusman'
            ],
            [
                'id' => 8,
                'nama' => 'Karman'
            ],
            [
                'id' => 9,
                'nama' => 'Agus'
            ],
            [
                'id' => 10,
                'nama' => 'Saprudin'
            ],
        ];

        return view('mahasantri/edit', compact('users', 'idd')); 
    }
    public function cari(Request $request) 
    {
       $cari = $request->get('cari');
        return view('mahasantri/cari',compact('cari'));
    }
}


