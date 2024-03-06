<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Buku extends Model
{
    use HasFactory;

    // ini buat ngasih tau nama table yang dipake
    // melupakan konsep plural dan singular
    protected $table  = 'buku';

    //ngasih tau primary key nya bukan id tapi yang lain
    // protected $primaryKey = 'id_kategori';
    protected $fillable = [
        'judul',
        'deskripsi',
        'penulisi',
        'sampul',
        'kategori_id',
        
    ];
    
    public function category()
    {
        return $this->belongsTo(Kategori::class,'kategori_id','id');
    }
}