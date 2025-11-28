<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   use HasFactory; // (Esta línea ya suele estar ahí)

    // Agrega esto:
    protected $fillable = ['sku', 'name', 'description', 'price', 'stock']; //
}
