<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pessage extends Model
{
    use HasFactory;
    protected $table = 'pessage';
    protected $primaryKey = 'pessageID';
    public $timestamps = true;

    protected $fillable = [
       'Nom_conducteur',
       'Nom_client', // Utiliser 'string' en minuscules
        'Numero_tiket',
        'numero_vehicule', // Utiliser 'string' en minuscules
        'Operateur', // Utiliser 'string' en minuscules
        'origine', // Supprimer l'espace après 'origine'
        'destination', // Utiliser 'string' en minuscules
        'type_materiel', // Utiliser 'string' en minuscules
        'Poids_brut',
       'Poids_tare',
      'Poids_net',
       'Date',
       'reference',
       'type',
       'color',
    ];
}
