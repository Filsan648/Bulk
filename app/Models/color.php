<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class color extends Model
{
    use HasFactory;
    protected $table = 'color';
    protected $primaryKey = 'colorID';
    public $timestamps = true;

    protected $fillable = [
       'color',
       'pessageID', // Utiliser 'string' en minuscules


    ];
}
