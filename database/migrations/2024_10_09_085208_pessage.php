<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {  Schema::create('pessage', function (Blueprint $table) {
        $table->id('pessageID');

        // Colonnes de la table
        $table->string('Nom_conducteur'); // Utiliser 'string' en minuscules
        $table->string('Nom_client'); // Utiliser 'string' en minuscules
        $table->bigInteger('Numero_tiket');
        $table->string('numero_vehicule'); // Utiliser 'string' en minuscules
        $table->string('Operateur'); // Utiliser 'string' en minuscules
        $table->string('origine'); // Supprimer l'espace après 'origine'
        $table->string('destination'); // Utiliser 'string' en minuscules
        $table->string('type_materiel'); // Utiliser 'string' en minuscules
        $table->float('Poids_brut'); 
        $table->float('Poids_tare'); 
        $table->float('Poids_net'); 
        $table->dateTime('Date'); 

        $table->timestamps();

        // 
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
