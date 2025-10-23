<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduitAppro extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
