<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public $buku;
    public function __construct()
    {
        $this->buku = new Buku();
    }
   
    public function index()
    {
        $buku = Buku::all();
        return view('buku.index', compact('buku'));
    }

    
    public function create()
    {
        // ngambil seluruh data dari tabel kategori 
        $kategori = Kategori::all();
        return view('buku.create',compact('kategori'));

        Alert::success('Successfull', 'Data Berhasil Di Tambah');

    }

  
    public function store(Request $request)
    {
        $rules = [
            // unique:nama_table,nama_field dan max ukuran file adalah kB
            'sampul' => 'required|mimes:jpg,png|max:999',
            'judul' => 'required|',
            'penulis' => 'required|',
            'kategori' => 'required|'
        ];
        // bikin pesan erros
        $messages = [
            'required' => ':attribute gak boleh kosong maseeeh',
            'max' => ':attribute ukuran/jumlah tidak sesuai',
            'mimes' => 'Extensi file tidak di dukung, Silakan gunaka(.jpg/.png)',
        ];
        // eksekusi fungsi
        $this->validate($request, $rules, $messages);

        // dd($request->all());
        $gambar = $request->sampul;

        // rename nama gambar to    
        // getClientOriginalExtension()untuk Mendapatkan extensi file
        // getClientOriginalName()untuk Mendapatkan Nama Asli file
        // echo time() . "<br>";
        // echo rand(100, 999) . "<br>";
        // $gambar->getClientOriginalExtension();

        $namaFile = time() . rand(100, 999). "." . $gambar->getClientOriginalExtension();
        // $namaFile = $gambar->getClientOriginalName();
        // echo $namaFile;

        $this->buku->sampul = $namaFile;
        $this->buku->judul = $request->judul;
        $this->buku->penulis = $request->penulis;
        $this->buku->deskripsi = $request->deskripsi;
        $this->buku->kategori_id = $request->kategori;

        // pindahin gambar asli ke dalam folder publik 
        $gambar->move(public_path(). '/upload',$namaFile);
        $this->buku->save();
        return redirect()->route('buku');
        // echo $namaFile;
    }

    
    public function show ($buku)  
    {
        $show = Buku::findorfail($buku);
        return view('buku.show',compact('show'));
    }

   
    public function edit($buku)
    {
        $kategori = Kategori::all();
        $show = Buku::findorfail($buku);
        return view('buku.edit',compact('show','kategori'));   
    }

    
    public function update(Request $request, Buku $buku)
    {
        $update = Buku::findorfail($buku);
        
        $rules = [
            // unique:nama_table,nama_field dan max ukuran file adalah kB
            'sampul' => 'mimes:jpg,png|max:999',
            'judul' => 'required|min:3',
            'penulis' => 'required|',
            'kategori' => 'required|'
        ];
       
        $messages = [
            'required' => ':attribute gak boleh kosong maseeeh',
            'max' => ':attribute ukuran/jumlah tidak sesuai',
            'min' => ':attribute terlalu sedikit',
            'mimes' => 'Extensi file tidak di dukung, Silakan gunaka(.jpg/.png)',
        ];

        $this->validate($request, $rules, $messages);

        // gimana klo gambar nya kosong
        if (!$request->sampul) {
            $update->judul = $request->judul;
            $update->penulis = $request->penulis;
            $update->deskripsi = $request->deskripsi;
            $update->kategori_id = $request->kategori;
            // $update->save();
            return redirect()->route('buku');

        }
        // gimna kalo nama gambarnya sama sedangkan gambarnya berbeda ?
        // replace gambar - 
        $gambar = $request->sampul;
        $namaFile = time() . rand(100, 999). "." . $gambar->getClientOriginalExtension();
        $gambar->move(public_path(). '/upload',$namaFile);

        $update->sampul = $namaFile;
        $update->judul = $request->judul;
        $update->penulis = $request->penulis;
        $update->deskripsi = $request->deskripsi;
        $update->kategori_id = $request->kategori;
        $update->save();
        return redirect()->route('buku.index');
    }

   
    public function destroy($id)
    {
        $delete = Buku::findOrFail($id);

        // fungsi buat ngapus daata
        $delete->delete();
        $path = 'upload/'. $delete->sampul;

        if (File::exists($path)) {
            File::delete($path);
        }
        // bisa juga pake if else
        // if($data){
        //     $data->delete();
        // }

        // tampilkan pesan berhasil
        Alert::success('Successfull', 'Data Anda Berhasil Di Hapus');

        // redirect halaman
        return redirect()->route('buku');
    }
}
