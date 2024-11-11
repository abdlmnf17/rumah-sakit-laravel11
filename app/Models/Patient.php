<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
   


     use HasFactory;

     protected $fillable = [
         'user_id', 'name', 'address', 'phone', 'medical_history',
     ];

     /**
      * Relasi dengan model User.
      * Setiap pasien terkait dengan satu user.
      */
     public function user()
     {
         return $this->belongsTo(User::class);
     }
}
