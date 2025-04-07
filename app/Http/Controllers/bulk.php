<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pessage;
use App\Http\Requests\loginrequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\passwordforget;

class bulk extends Controller
{
    public function login_get()
    {
        // Récupère tous les messages de la base de données
        $COUNT=pessage::where('type','stock')->where('Nom_client','null')->count();


            return view('connexion',compact('COUNT'));

        // Retourne la vue avec les messages
    }


    public function login_post(loginrequest $request)
    {
        // Récupère tous les messages de la base de données
        $credentials = $request->validated();


        // Tentative d'authentification
        if (Auth::attempt($credentials)) {
            // Régénérer la session
            $request->session()->regenerate();

            // Vérifier si l'utilisateur est admin
   return redirect()->route('form_get');

        }

        // Retourner avec des erreurs si l'authentification échoue
        return to_route('login_get')->withErrors([
            'email' => 'email invalid'
        ])->onlyInput('email');

// Retourne la vue avec les messages

    }
    public function form_get()
    {
        // Récupère tous les messages de la base de données
        $pessages=pessage::all();
        $COUNT=pessage::where('type','stock')->where('Nom_client','null')->count();


            return view('form',compact('pessages','COUNT'));


    }
    public function form_post(Request $request)
    {
        $ref= $request->input('reference');
        $userName = Auth::user()->name;
        $net=$request->input('Poids_brut')-$request->input('Poids_tare');
          if($ref=='sorti'){
            $nomClient = $request->input('Nom_client') === 'new' ? $request->input('new_nom_client') : $request->input('Nom_client');

            // Récupère tous les messages de la base de données
            $pessage = pessage::create([
            'Nom_conducteur'=>$request->input('Nom_conducteur'),
            'Nom_client'=>$nomClient, // Utiliser 'string' en minuscules
            'Numero_tiket'=>$request->input('Nom_conducteur'),
            'numero_vehicule'=>$request->input('numero_vehicule'), // Utiliser 'string' en minuscules
            'Operateur'=> $userName, // Utiliser 'string' en minuscules
            'origine'=>$request->input('origine'), // Supprimer l'espace après 'origine'
            'destination'=>$request->input('destination'), // Utiliser 'string' en minuscules
            'type_materiel'=>$request->input('type_materiel'), // Utiliser 'string' en minuscules
            'Poids_brut'=>$request->input('Poids_brut'),
            'Poids_tare'=>$request->input('Poids_tare'),
            'Poids_net'=> $net,
            'Date'=>$request->input('Date'),

            ]);
            $newReference = 'REF' . str_pad($pessage->pessageID, 2, '0', STR_PAD_LEFT);

            // Mettre à jour l'enregistrement avec la nouvelle référence
            $pessage->update(['reference' => $newReference]);

        }
       elseif($ref=='entree'){
        $net=$request->input('Poids_brut')-$request->input('Poids_tare');

        $refere=pessage::where('pessageID', $request->input('marticule'))->first();

        $pessage = pessage::create([
            'Nom_conducteur'=> $refere->Nom_conducteur,
            'Nom_client'=> $refere->Nom_client, // Utiliser 'string' en minuscules
            'Numero_tiket'=>$request->input('Nom_conducteur'),
            'numero_vehicule'=>$refere->numero_vehicule, // Utiliser 'string' en minuscules
            'Operateur'=> $userName, // Utiliser 'string' en minuscules
            'origine'=> $refere->origine, // Supprimer l'espace après 'origine'
            'destination'=> $refere->destination, // Utiliser 'string' en minuscules
            'type_materiel'=> $refere->type_materiel, // Utiliser 'string' en minuscules
            'Poids_brut'=>$request->input('Poids_brut'),
            'Poids_tare'=>$request->input('Poids_tare'),
            'Poids_net'=> $net,
            'Date'=>$request->input('Date'),
            'reference'=>$refere->reference,
            'type'=>'entree', ]);
        pessage::where('pessageID', $refere->pessageID)->update([
            'color' => '1',
            ]);


    }
    else{
        $nomClient = $request->input('Nom_client') === 'new' ? $request->input('new_nom_client') : $request->input('Nom_client');


        $pessage = pessage::create([
        'Nom_conducteur'=>$request->input('Nom_conducteur'),
        'Nom_client'=>'null', // Utiliser 'string' en minuscules
        'Numero_tiket'=>$request->input('Nom_conducteur'),
        'numero_vehicule'=>$request->input('numero_vehicule'), // Utiliser 'string' en minuscules
        'Operateur'=> $userName, // Utiliser 'string' en minuscules
        'origine'=>'CIMAS', // Supprimer l'espace après 'origine'
        'destination'=>'null',
        'type_materiel'=>$request->input('type_materiel'),
        'Poids_brut'=>$request->input('Poids_brut'),
        'Poids_tare'=>$request->input('Poids_tare'),
        'Poids_net'=> $net,
        'type'=>'stock',
        'Date'=>$request->input('Date'),
     ]);
        $newReference = 'REF' . str_pad($pessage->pessageID, 2, '0', STR_PAD_LEFT);
        $pessage->update(['reference' => $newReference]);

    }


        return redirect()->back()->with('success', 'L\'utilisateur a été ajouté avec succès.');

        // Retourne la vue avec les messages
    }
    public function formaffiche_get()
    {

        $COUNT=pessage::where('type','stock')->where('Nom_client','null')->count();


        $pessages=pessage::all();

            return view('vueform',compact('pessages','COUNT'));


    }
    public function client_get()
    {
        $pessages=pessage::whereNot('Nom_client','null')->get();

        $COUNT=pessage::where('type','stock')->where('Nom_client','null')->count();


            return view('choixpessage',compact('pessages','COUNT'));

    }
    public function navbar()
    {
        $COUNT=pessage::where('type','stock')->where('Nom_client','null')->count();


            return view('navbar',compact('COUNT'));


    }
    public function formaffiche_post(Request $request)
    {
        $COUNT=pessage::where('type','stock')->where('Nom_client','null')->count();
         return view('choixpessage',compact('COUNT'));


    }
    public function client_post(Request $request)
    {

           $pessages=pessage::where('Nom_client', $request->input('Nom_client'))->where('type', 'sorti')->get();
           $COUNT=pessage::where('type','stock')->where('Nom_client','null')->count();

            return view('vueform',compact('pessages','COUNT'));

    }

    public function Imprimer( $id)
    {
        $COUNT=pessage::where('type','stock')->where('Nom_client','null')->count();

        $pessages=pessage::where('pessageID', $id)->get();

            return view('imprimer',compact('pessages','COUNT'));


    }
    public function Refernce_entrer( $id)
    {
        $COUNT=pessage::where('type','stock')->where('Nom_client','null')->count();

        $pessages=pessage::where('reference', $id)->where('type', 'entree')->get();
        $pessages_sorti=pessage::where('reference', $id)->where('type', 'sorti')->first();

            return view('referenceentree',compact('pessages','pessages_sorti','COUNT'));

        // Retourne la vue avec les messages
    }
    public function forget_password( )
    {


            return view('password');

        // Retourne la vue avec les messages
    }



    public function forget_password_post( Request $request)
    {
        $user=User::where('email',$request->input('email'))->first();
        $user->notify(new passwordforget());

        return redirect()->back()->with('success', 'L\'Veuillew voir votre email.');


    }
    public function update_password_get( )
    {

        $COUNT=pessage::where('type','stock')->where('Nom_client','null')->count();

            return view('update',compact('COUNT'));


    }
    public function update_password_post(loginrequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Trouver l'utilisateur par email
        $user = User::where('email', $email)->first();

        if ($user) {
            // Mettre à jour le mot de passe
            $user->password = Hash::make($password);
            $user->save();

            // Envoyer un message de succès
            return redirect()->back()->with('success', 'Votre mot de passe a été mis à jour avec succès !');
        }

        // Si l'utilisateur n'est pas trouvé (ce cas est couvert par la validation)
        return redirect()->back()->with('error', 'Utilisateur non trouvé.');
    }


    public function logout(Request $request)
    {
        Auth::logout(); // Déconnecter l'utilisateur

        $request->session()->invalidate(); // Invalider la session actuelle
        $request->session()->regenerateToken(); // Regénérer le token CSRF pour la sécurité

        return redirect('/'); // Rediriger vers la page de connexion après déconnexion
    }
    public function updat_password(Request $request)
    {
        $COUNT=pessage::where('type','stock')->where('Nom_client','null')->count();

       return view('modifierpassword',compact('COUNT'));
    }

    public function updat_password_post(Request $request)
    {
        $request->validate([
            'passwordfirst' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required',
        ]);

        // Vérifier si l'ancien mot de passe est correct
        if (!Hash::check($request->passwordfirst, Auth::user()->password)) {
            return back()->withErrors(['passwordfirst' => 'L\'ancien mot de passe est incorrect.']);
        }

        // Vérifier si le nouveau mot de passe et la confirmation sont identiques
        if ($request->new_password !== $request->confirm_password) {
            return back()->withErrors(['confirm_password' => 'Le nouveau mot de passe et la confirmation ne correspondent pas.']);
        }

        // Mettre à jour le mot de passe
        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Le mot de passe a été mis à jour avec succès.');
    }

    public function pen_entry($id){
        $pessage=pessage::where('pessageID',$id)->first();

        return view('updateentree',compact('pessage'));
    }
    public function pen_exit($id){
        $pessage=pessage::where('pessageID',$id)->first();

        return view('updatesortie',compact('pessage'));
    }
    public function updat_entry(Request $request, $id)
    {

        $pessage = pessage::findOrFail($id);

        // Préparer les données pour la mise à jour
        $data = [];
        if (in_array('Nom_client', $request->input('modify_fields', []))) {
            $data['Nom_client'] = $request->input('Nom_client');
        }

        // Vérifier quels champs ont été sélectionnés pour la mise à jour
        if (in_array('Nom_conducteur', $request->input('modify_fields', []))) {
            $data['Nom_conducteur'] = $request->input('Nom_conducteur');
        }

        if (in_array('Numero_tiket', $request->input('modify_fields', []))) {
            $data['Numero_tiket'] = $request->input('Numero_tiket');
        }

        if (in_array('Operateur', $request->input('modify_fields', []))) {
            $data['Operateur'] = $request->input('Operateur');
        }

        if (in_array('origine', $request->input('modify_fields', []))) {
            $data['origine'] = $request->input('origine');
        }

        if (in_array('destination', $request->input('modify_fields', []))) {
            $data['destination'] = $request->input('destination');
        }

        if (in_array('Operateur', $request->input('modify_fields', []))) {
            $data['Operateur'] = $request->input('Operateur');
        }

        if (in_array('type_materiel', $request->input('modify_fields', []))) {
            $data['type_materiel'] = $request->input('type_materiel');
        }
        if (in_array('Poids_brut', $request->input('modify_fields', []))) {
            $data['Poids_brut'] = $request->input('Poids_brut');
            // Recalculer le poids net si le poids brut change
            $data['Poids_net'] = $request->input('Poids_brut') - $pessage->Poids_tare;
        }

        if (in_array('Poids_tare', $request->input('modify_fields', []))) {
            $data['Poids_tare'] = $request->input('Poids_tare');
            // Recalculer le poids net si le poids tare change
            $data['Poids_net'] = $pessage->Poids_brut - $request->input('Poids_tare');
        }

        // Si les deux poids sont modifiés en même temps
        if (in_array('Poids_brut', $request->input('modify_fields', [])) &&
            in_array('Poids_tare', $request->input('modify_fields', []))) {
            $data['Poids_net'] = $request->input('Poids_brut') - $request->input('Poids_tare');
        }

        if (in_array('Date', $request->input('modify_fields', []))) {
            $data['Date'] = $request->input('Date');
        }
        if (in_array('numero_vehicule', $request->input('modify_fields', []))) {
            $data['numero_vehicule'] = $request->input('numero_vehicule');
        }
         $pessage->update($data);
      // Redirection avec un message de succèss
        return redirect()->back()->with('success', 'Le mot de passe a été mis à jour avec succès.');
    }

    public function destroy($id,$ref)
    {
        $pessage = pessage::findOrFail($id);
        $pessage->delete();
        return redirect()->back()->with('success', 'Pessage supprimé avec succès.');
    }
    function Homef (){
        return view('Home');
    }


}

