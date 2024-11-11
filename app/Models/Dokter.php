<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Dokter extends Model
{
    use HasFactory;

    // Tentukan kolom mana yang boleh diisi mass-assignment
    protected $fillable = [
        'name',       // Nama dokter
        'email',      // Email dokter
        'specialty',  // Spesialisasi dokter
        'phone',      // Nomor telepon dokter
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
