<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;



class KategoriController extends Controller
{
    public $kategori;
    public function __construct()
    {
        $this->kategori = new Kategori();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /*menampilkan data dari tabel kategori
        * menggunakan sintaks eloquent
        */ 
        // ini sintaxs elequen
        // $data = Kategori::all();

        // ini kalo menggunakan sintaks query builder
        // $data = DB::table('kategori')->simplePaginate(5);

        // untuk mencari tangkapan user
        $cari = $request->get('search');
        
        $batas = 5;
        $data = DB::table('kategori')
        ->where('kategori', 'LIKE', "%$cari%")

        // sintax ini dipake klo nyari data lebih dari 1 field 
        // jika lebih dari 2 field maka tambahkan orwhere lagi
        // ->orwhere('jumlah', 'LIKE', "%$cari%")
        
        ->Paginate($batas);

        $no = $batas * ($data->currentPage() -1);
        return view('kategori.index', compact('data','no','batas','cari'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /*fungsi create untuk membuat data dan redirect ke form tambah
        * fungsi cuma untuk return value to
        */
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //fungsi store untuk menyimpan/melihat data dari table/data yang lain 
        // saya tangkep dlu inputan user  
        // dd($request->all());

        //validasi V.1
        // $validated = $request->validate([
        //     'nama_kategori' => 'required',
        // ]);

        //validasi V.2
        // aturan main
        $rules = [
            // unique:nama_table,nama_field
            'nama_kategori' => 'required|min:3|max:20|unique:kategori,kategori'
        ];
        // bikin pesan erros
        $messages = [
            'nama_kategori' => 'Isi dulu kalo mau nambah data',
            'min' => ':attribute Minimal 3 Huruf',
            'max' => ':attribute Maximal 20 Huruf',
            'unique' => ':attribute Sudah Ada Silahkan gunakan yang lain'
        ];
        // eksekusi fungsi
        $this->validate($request, $rules, $messages);

        //saya pasangkan ke field tabelnya dengan kiriman user 
        $this->kategori->kategori = $request->nama_kategori;

        //lalu simpan ke database saya
        $this->kategori->save();

        Alert::success('Success', 'Data Sudah di tambahkan');


        //redirect
        //ini gak pake sweetalert
        // return redirect()->route('kategori')-> with('status','Success');

        // ini pake sweetalert jadi cukup redirect aja
        return redirect()->route('kategori');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //fungsi show untuk menampilkan data dari table/data yang lain //
         $kategori = Kategori::findorfail($id);

        //  buat ngecek data kekirim ato nggak
        //  dd($kategori->all());

         return view('kategori.show',compact('kategori'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        /*fungsi edit untuk mengedit data dari table/data yang lain 
        * bisa redirect juga sambil membawa data yang membawa id
        */
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update = Kategori::findOrFail($id);
 
        // cek ada perubahan ato nggak?
        // isDirty() buat ngecek field tabel ada perubahan atau nggak
        // dengan kiriman data dri form
        $update->kategori = $request->nama_kategori;
        if ($update->isDirty()) {
            $rules = [
            'nama_kategori' => 'required|min:3|max:20|unique:kategori,kategori'
        ];
        // bikin pesan erros
        $messages = [
            'required' => 'Isi dulu kalo mau update',
            'min' => 'Pesan Minimal 3 Huruf',
            'max' => 'Pesan Maximal 20 Huruf',
            'unique' => ':attribute Sudah Ada Silahkan gunakan yang lain'
        ];
        // eksekusi fungsi
        $this->validate($request, $rules, $messages);

        //saya pasangkan ke field tabelnya dengan kiriman user 
        $data['kategori'] = $request->nama_kategori;
        Kategori::whereId($id)->update($data);
        Alert::success('Successfull', 'Data Anda Berhasil Di Update');
        //redirect
        //ini gak pake sweetalert
        // return redirect()->route('kategori')-> with('status','Success');

        // ini pake sweetalert jadi cukup redirect aja
        return redirect()->route('kategori');

        } else {
            return redirect()->route('kategori');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /*fungsi detroy untuk menghapus data dari table/data yang lain 
        */
        { 
            // ambil data sesuai id nya
            $kategori = Kategori::findOrFail($id);

            // fungsi buat ngapus daata
            $kategori->delete();

            // bisa juga pake if else
            // if($data){
            //     $data->delete();
            // }

            // tampilkan pesan berhasil
            Alert::success('Successfull', 'Data Anda Berhasil Di Hapus');

            // redirect halaman
            return redirect()->route('kategori');
        }
    }

}
