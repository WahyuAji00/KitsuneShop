<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    // Nama tabel jika tidak menggunakan penamaan default Laravel (plural)
    protected $table = 'products';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'image',
        'name',
        'description',
        'price',
        'stock',
        'category',
        'status',
        'wishlist_count'
    ];

    // Kolom-kolom yang harus disembunyikan dari array dan JSON
    protected $hidden = [
        // Kolom yang tidak ingin ditampilkan di array/JSON (opsional)
    ];

    // Format data tanggal
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Mengatur format harga (opsional)
    protected $casts = [
        'price' => 'decimal:2',
        'status' => 'boolean',
    ];

    public function sales() {
        return $this->hasMany(Sale::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
