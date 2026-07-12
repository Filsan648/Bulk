<?php

namespace App\Http\Controllers;
use App\Models\pessage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class addition extends Controller
{

    public function Rechercher()
    {         $COUNT=pessage::where('type','stock')->where('Nom_client','null')->count();

        $client = pessage::pluck('Nom_client')->unique();
        return view('Rechercher',compact('client','COUNT'));
    }

   public function Rechercher_post(Request $request)
    {
  $client = pessage::pluck('Nom_client')->unique();
  $COUNT=pessage::where('type','stock')->where('Nom_client','null')->count();

if($request->input('type')!="ALL"){
$resultats = pessage::whereBetween('Date', [
    $request->input('date_debut'),
    $request->input('date_fin')
 ])->where('Nom_client',$request->input('type'))->where('type','entree')->get();

 $Total = pessage::whereBetween('Date', [
    $request->input('date_debut'),
    $request->input('date_fin')
])->where('Nom_client', $request->input('type'))
  ->where('type', 'entree')
  ->sum('Poids_net');

}
 else{
    $resultats = pessage::whereBetween('Date', [
    $request->input('date_debut'),
    $request->input('date_fin')
 ])->where('type','entree')->get();

 $Total = pessage::whereBetween('Date', [
    $request->input('date_debut'),
    $request->input('date_fin')
 ])->where('type','entree')->sum('Poids_net');
}


        return view('Rechercher', compact('resultats','client','COUNT','Total'));
    }



    
    
    

  function Bar_chart(Request $request){
      $annee = $request->input('annee', date('Y'));
      $COUNT=pessage::where('type','stock')->where('Nom_client','null')->count();

//barchart
  $data = pessage::where('type','entree')
       ->whereYear('Date', $annee)
    ->selectRaw('DISTINCT DATE_FORMAT(Date, "%M") as month') // Sélectionner le mois en lettres
    ->pluck('month'); // Récupérer les mois    $pessage_bar = [];
    $mont_bar=[];
 foreach($data as $dat ){
   $mont_bar[]=$dat;
 }
 $clients=[];

foreach($mont_bar as $mont){
    $pessage_bar[] = pessage::where('type', 'entree')
         ->whereYear('Date', $annee)
    ->whereRaw('DATE_FORMAT(Date, "%M") = ?', [$mont]) // Comparer le mois en lettres
    ->sum('Poids_net');

}




  //bar client
 $data_clients= pessage::where('type', 'entree')->distinct()->pluck('Nom_client');
  $client_month=[];
  $count_client=[];
foreach($data_clients as $data){
$clients[]=$data;
}
$poid_net=[];
foreach($clients as $client){
     $client_months= pessage::
     where('type', 'entree')
    ->selectRaw('DISTINCT DATE_FORMAT(Date, "%M") as month') // Sélectionner uniquement le mois
    ->whereYear('Date', $annee)
    ->pluck('month');
}
$cliets = pessage::selectRaw('DISTINCT Nom_client, MONTHNAME(Date) as Mois')
    ->where('type', 'entree')
    ->get()
    ->groupBy('Nom_client');

$data = [];
foreach ($cliets as $clientName => $datas) {
    foreach ($datas as $group) {
        $data[$clientName][] = [
            'Mois' => $group->Mois,
            'Poid' => pessage::where('type', 'entree')
                ->where('Nom_client', $clientName)
                ->whereYear('Date', $annee)
                ->whereRaw('DATE_FORMAT(Date, "%M") = ?', [$group->Mois])
                ->sum('Poids_net'),
            'clientNom' => $clientName
        ];
    }
}


 //Chauffeur
$chauffeurs = pessage::selectRaw('DISTINCT Nom_conducteur, MONTHNAME(Date) as Mois')
    ->where('type', 'entree')
    ->get()
    ->groupBy('Nom_conducteur');


    $chauffeur=[];
    $pessages=pessage::where('type','entree')->pluck('Nom_conducteur')->unique();
    foreach($pessages as $pessage ){
        $chauffeur[]=$pessage;
    }
    $countchauffeur=[];
    foreach($chauffeur as $chauff){
      $countchauffeur[]=pessage::where('Nom_conducteur',$chauff)->where('type','entree')->count();
    }
$DATAchauffeur=[];
foreach ($chauffeurs as $chauf => $datas) {
    foreach ($datas as $group) {
        $DATAchauffeur[$chauf][] = [
            'Mois' => $group->Mois,
            'voyage' => Pessage::where('type', 'entree')
                ->where('Nom_conducteur', $chauf)
                ->whereRaw('DATE_FORMAT(Date, "%M") = ?', [$group->Mois])
                ->whereYear('Date', $annee)
                ->count(),
                'chauf' => $chauf];
    }
}

foreach($client_months as $months){
$client_month[]=$months;
}

 //Resume
 $POIDS_TOTAL = pessage::where('type', 'entree')->whereYear('Date', $annee)
->sum('Poids_net') / 1000;

$Livraision=pessage::where('type', 'entree')->whereYear('Date', $annee)
                ->count();

$Nbr_clie = pessage::where('Nom_client', '!=', 'null')
->distinct('Nom_client')
->count('Nom_client');


return view('BartChart', compact('pessage_bar'
,'mont_bar'
,'chauffeur'
,'countchauffeur'
,'clients'
,'count_client'
,'client_month'
,'poid_net'
,'data'
,'COUNT'
,'DATAchauffeur',
'POIDS_TOTAL',
'Livraision',
'Nbr_clie'
));
  }

    
    
    
    
    
    
    
function stock(){
    $pessages=pessage::where('type', 'stock')->orderBy('created_at', 'desc')->get();
    $Nom_client=pessage::where('type','sorti')->distinct()->pluck('Nom_client');
    $COUNT=pessage::where('type','stock')->where('Nom_client','null')->count();
    $pessagesmonths = pessage::pluck('Date')->map(function ($date) {
        return Carbon::parse($date)->translatedFormat('F'); // Affiche le mois en français
    })->unique();
    return view('stock',compact('pessages','Nom_client','COUNT','pessagesmonths'));
}
function post_stock( $id,Request $request ){
    $refere=pessage::where('pessageID',$id)->first();
    $userName = Auth::user()->name;
    $net=$request->input('poids_brut')-$request->input('poids_tare');

    $newReference = 'REF' . str_pad($id, 2, '0', STR_PAD_LEFT);
     pessage::create([
        'Nom_conducteur'=> $refere->Nom_conducteur,
        'Nom_client'=> $request->input('client'),
        'Numero_tiket'=>'null',
        'numero_vehicule'=>$refere->numero_vehicule,
        'Operateur'=> $userName,
        'origine'=> $request->input('origine') ,
        'destination'=> $request->input('destination'),
        'type_materiel'=> $refere->type_materiel,
        'Poids_brut'=>$request->input('poids_brut'),
        'Poids_tare'=>$request->input('poids_tare'),
        'Poids_net'=> $net,
        'Date'=>$request->input('Date'),
        'reference'=>$newReference,
        'type'=>'entree',
           'color' => '1' ]);

           pessage::where('pessageID',  $id)->update([
           'Nom_client'=> $request->input('client'),
            ]);


        pessage::create([
            'Nom_conducteur'=> $refere->Nom_conducteur,
            'Nom_client'=> $request->input('client'),
            'Numero_tiket'=>'null',
            'numero_vehicule'=>$refere->numero_vehicule,
            'Operateur'=> $userName,
            'origine'=> $request->input('origine') ,
            'destination'=>$request->input('destination'),
            'type_materiel'=>$refere->type_materiel,
            'Poids_brut'=>$refere->Poids_brut,
            'Poids_tare'=>$refere->Poids_tare,
            'Poids_net'=> $refere->Poids_net,
            'Date'=>$refere->Date,
            'reference'=>$newReference,
            'type'=>'sorti',
        'color' => '1']);

            return redirect()->back()->with('success', 'L\'utilisateur a été ajouté avec succès.');
}

function Stockaffiche($id){
    $pessages=pessage::where('pessageID',$id)->get();
return view('AfficheStock',compact('pessages'));
}
  public function montpost(Request $request){
            $mois = $request->input('mois');
            $pessagesmonths = pessage::pluck('Date')->map(function ($date) {
                return Carbon::parse($date)->translatedFormat('F'); // Affiche le mois en français
            })->unique();
            $Nom_client=pessage::where('type','sorti')->distinct()->pluck('Nom_client');


            if($mois ==="ALL"){
                $pessages = Pessage::where('type', 'stock')->whereYear('Date', $request->input('annee'))
               ->get();

               $COUNT=pessage::where('type','stock')->where('Nom_client','null')->count();

           return view('stock',compact('pessages','Nom_client','COUNT','pessagesmonths'));
            }
            $moisNumero = Carbon::parse("1 $mois")->month;
            $pessages = Pessage::where('type', 'stock')
                ->whereMonth('Date', $moisNumero)
                ->whereYear('Date', $request->input('annee'))
                ->get();

               $COUNT=pessage::where('type','stock')->where('Nom_client','null')->whereMonth('Date', $moisNumero)->count();

            return view('stock',compact('pessages','Nom_client','COUNT','pessagesmonths'));

        }
           public function filtreAFFICHAGE(Request $request, $id)
{
    $mois = $request->input('mois');
    $Nom_client = $id;

    // Récupération des mois pour le select
    $pessagesmonths = pessage::where('Nom_client', $Nom_client)
        ->where('type', 'sorti')
        ->selectRaw('MONTH(Date) as mois')
        ->distinct()
        ->orderBy('mois')
        ->pluck('mois')
        ->map(function ($mois) {
            return [
                'value' => $mois,
                'nom' => ucfirst(
                    Carbon::create()->month($mois)
                        ->locale('fr')
                        ->translatedFormat('F')
                ),
            ];
        });


    if ($mois === "ALL") {

        $pessages = Pessage::where('type', 'entree')
            ->where('Nom_client', $id)
            ->whereYear('Date', $request->input('annee'))
            ->get();

        $COUNT = pessage::where('type', 'entree')
            ->whereNull('Nom_client')
            ->count();

    } else {

        $pessages = Pessage::where('type', 'entree')
            ->where('Nom_client', $id)
            ->whereMonth('Date', $mois)
            ->whereYear('Date', $request->input('annee'))
            ->get();

        $COUNT = pessage::where('type', 'stock')
            ->whereNull('Nom_client')
            ->whereMonth('Date', $mois)
            ->count();
    }


    return view('vueform', compact(
        'pessages',
        'COUNT',
        'pessagesmonths',
        'Nom_client'
    ));
}
}
