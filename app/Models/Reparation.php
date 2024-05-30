<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparation extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle' , 'quantite' , 'prix_un' , 'prix' , 'date'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
