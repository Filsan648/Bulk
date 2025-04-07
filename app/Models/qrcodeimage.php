<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class qrcodeimage extends Model
{
    use HasFactory;
    protected $table = 'Qrcode';
    protected $primaryKey = 'QrcodeID';
    public $timestamps = true;

    protected $fillable = [
       'image', 
       'idpesse', 
        
    ];
}
