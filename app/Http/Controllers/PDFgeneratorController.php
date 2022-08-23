<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\infosndf;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PDFgeneratorController extends Controller
{
    public function PDFgenerator(Request $request)
    {

        $utilisateurs = DB::table('users')->RightJoin("events", "events.idUser", "users.id")->where("idUser", "=", Auth::user()->id)->get();
        $user = Auth::user();
        // dd($user);
        if($user->vehicule == null || $user->chevauxFiscaux == null){
            return redirect('dashboard')->with('failure', 'Le PDF n\'a pas pu être généré car les données "Type de vehicule" ou "Chevaux fiscaux" ne sont pas rempli.');
        };
        if ($utilisateurs->isEmpty()) {
            return redirect('dashboard')->with('failure', 'L\'utilisateur n\'a pas d\'événement enregistré pour ce mois !');
        };


        // $date = 0;
        // $moisencours = Carbon::createFromFormat("m/d/Y");

        $pdf = PDF::loadView('pdf.PDFnotesdefrais', compact("utilisateurs"));
        // dd($pdf);
        return $pdf->stream('pdf.PDFnotesdefrais' . '.pdf');
    }

    public function PDFgeneratorPerMonth(Request $request, $userId)
    {


        // - On recupère tous les événements correspondants au mois à l'ecran et au user concerné
        $utilisateurs = DB::table('users')->RightJoin("events", "events.idUser", "users.id")->where("idUser", "=", $userId)->where('mois','=', $request->selectedMonth)->get();
        if(count($utilisateurs) == 0){
            Session::flash("noevents","Il n'y a aucun évènements pour ce mois-ci !");
            return redirect('dashboard');
        }
        $ndf = DB::table('infosndfs')->where('MoisEnCours','=',$request->selectedMonth)->where("Utilisateur", "=", $utilisateurs[0]->name)->get();

        // - Gestion du cas dans lequel il n'y a pas d'évenements sur le mois
        if ($utilisateurs->isEmpty()) {
            return redirect('gestionaireUser')->with('failure', 'L\'utilisateur n\'a pas d\'événement enregistré pour ce mois !');
        };

        // - Si cette note de frais existe deja, elle ne sera pas créée en double
    if(count($ndf) == 0)
        infosndf::create([
                'Utilisateur' => $utilisateurs[0]->name,
                'MoisEnCours' => $request->selectedMonth,
                'NombreEvenement' => count($utilisateurs),
                'ChevauxFiscaux' => $utilisateurs[0]->chevauxFiscaux,
                ]);

        // - On load le PDF grace a DOMPDF
        $pdf = PDF::loadView('pdf.PDFnotesdefrais', compact("utilisateurs"));
        // dd($pdf);
        return $pdf->stream('pdf.PDFnotesdefrais' . '.pdf');
    }

    public function userPDFgenerator(Request $request, $userId)
    {
        $utilisateurs = DB::table('users')->rightJoin("events", "events.idUser", "users.id")->where('idUser', "=", $userId)->get();

        if ($utilisateurs->isEmpty()) {
            return redirect('gestionaireUser')->with('failure', 'L\'utilisateur n\'a pas d\'événement à son nom !');
        };

        $pdf = PDF::loadView('pdf.PDFnotesdefrais', compact("utilisateurs"));
        return $pdf->stream('pdf.PDFnotesdefrais' . '.pdf');
    }
}
