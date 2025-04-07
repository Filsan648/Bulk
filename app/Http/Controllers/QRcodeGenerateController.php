<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\qrcodeimage;

class QRcodeGenerateController extends Controller
{
    public function qrcode(){
        $url=route('generate.form');
        

        $qrCodes = [];
        $qrCodes['simple'] = 
        QrCode::size(150)->generate('/');
        $qrCodes['changeColor'] = 
        QrCode::size(150)->color(255, 0, 0)->generate('http://cimas.kesug.com/');
        $qrCodes['changeBgColor'] = 
        QrCode::size(150)->backgroundColor(255, 0, 0)->generate('http://cimas.kesug.com/');
        $qrCodes['styleDot'] = 
        QrCode::size(150)->style('dot')->generate('http://cimas.kesug.com/');
        $qrCodes['styleSquare'] = QrCode::size(150)->style('square')->generate('http://cimas.kesug.com/');
        $qrCodes['styleRound'] = QrCode::size(150)->style('round')->generate('http://cimas.kesug.com/');
    
        return view('qrcode',$qrCodes);
    }

    public function takeScreenshot(Request $request)
    {
        if ($request->hasFile('screenshot')) {
            $image = $request->file('screenshot');
            // Sauvegarder l'image dans le dossier public/screenshots
            $imagePath = $image->storeAs('screenshots', 'capture-' . time() . '.png', 'public');
    
            // Générer le QR Code à partir du chemin de l'image téléchargée
            $qrCode = new QrCode('data:image/png;base64,' . base64_encode(file_get_contents(storage_path('app/public/' . $imagePath))));
    
            // Définissez la taille du QR Code
            $qrCode->setSize(150);
    
            // Spécifier le chemin pour sauvegarder le QR Code
            $qrCodePath = 'qrcodes/qr-' . time() . '.png';
    
            // Sauvegarder le QR Code dans public/qrcodes
            Storage::disk('public')->put($qrCodePath, $qrCode->writeString());
            $qrCodePaths=$qrCode->storeAs('screenshots', 'capture-' . time() . '.png', 'public');
            // Retourner la réponse avec les chemins des fichiers sauvegardés
            return response()->json([
                'success' => true,
                'imagePath' => $imagePath,
                'qrCodePath' => $qrCodePath
            ]);
        }
    
        // Si aucune image n'est téléchargée, retourner une réponse d'erreur
        return response()->json(['success' => false, 'message' => 'Aucune capture d\'écran fournie.'], 400);
    }
}