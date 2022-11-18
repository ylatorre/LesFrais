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
            return redirect(route("dashboard"))->with('failure', 'Le PDF n\'a pas pu être généré car les données "Type de vehicule" ou "Chevaux fiscaux" ne sont pas rempli.');
        };
        if ($utilisateurs->isEmpty()) {
            return redirect(route("dashboard"))->with('failure', 'L\'utilisateur n\'a pas d\'événement enregistré pour ce mois !');
        };


        // $date = 0;
        // $moisencours = Carbon::createFromFormat("m/d/Y");

        $pdf = PDF::loadView('pdf.PDFnotesdefrais', compact("utilisateurs"));
        // dd($pdf);
        return $pdf->stream('pdf.PDFnotesdefrais' . '.pdf');
    }

    public function PDFgeneratorPerMonth(Request $request)
    {


        // - On recupère tous les événements correspondants au mois à l'ecran et au user concerné
        $utilisateurs = DB::table('users')->RightJoin("events", "events.idUser", "users.id")->where("idUser", "=", $request->idUser)->where('mois','=', $request->selectedMonth)->orderBy("start","asc")->orderBy("title","asc")->get();


        if(count($utilisateurs) == 0){
            Session::flash("noevents","Il n'y a aucun évènements pour ce mois-ci !");
            return redirect(route("dashboard"));
        }
        if($utilisateurs[0]->chevauxFiscaux == null){
            Session::flash("noCHF","Cet utilisateur n'a pas de puissance fiscal enregistrée !");
            return redirect(route("dashboard"));
        }
        if($utilisateurs[0]->vehicule == null){
            Session::flash("novehicule","Cet utilisateur n'a pas de véhicule enregistré !");
            return redirect(route("dashboard"));
        }

        $ndf = DB::table('infosndfs')->where('MoisEnCours','=',$request->selectedMonth)->where("Utilisateur", "=", $utilisateurs[0]->name)->get();
        $dateDuJour = date('d/m/Y');

        // - Gestion du cas dans lequel il n'y a pas d'évenements sur le mois
        if ($utilisateurs->isEmpty()) {
            return redirect('gestionaireUser')->with('failure', 'L\'utilisateur n\'a pas d\'événement enregistré pour ce mois !');
        };

        // - Si cette note de frais existe deja, elle ne sera pas créée en double
    if(count($ndf) == 0)

        infosndf::create([
                'Utilisateur' => $utilisateurs[0]->name,
                'MoisEnCours' => $request->selectedMonth,
                'DateSoumission' => $dateDuJour,
                'NombreEvenement' => count($utilisateurs),
                'ChevauxFiscaux' => $utilisateurs[0]->chevauxFiscaux,
                'tauxKM' => $utilisateurs[0]->taux
                ]);
        if(Auth::user()->superadmin == 1){
        DB::table('infosndfs')->where('Utilisateur','=', $utilisateurs[0]->name)->where('MoisEnCours','=',$request->selectedMonth)->update(['Valide' => 1]);
        DB::table('infosndfs')->where('Utilisateur','=', $utilisateurs[0]->name)->where('MoisEnCours','=',$request->selectedMonth)->update(['ValidationEnCours' => 0]);
        DB::table('infosndfs')->where('Utilisateur','=', $utilisateurs[0]->name)->where('MoisEnCours','=',$request->selectedMonth)->update(['ValideePar' => Auth::user()->name]);
        DB::table('infosndfs')->where('Utilisateur','=', $utilisateurs[0]->name)->where('MoisEnCours','=',$request->selectedMonth)->update(['DateValidation' => date('d/m/Y')]);
        }

        $infosNDF = DB::table('infosndfs')->where('Utilisateur','=', $utilisateurs[0]->name)->where('MoisEnCours','=',$request->selectedMonth)->get();

        $dateNDF = explode("-",$utilisateurs[0]->mois);



        // - Le switch case permet d'écrire sur la note de frais le mois en fonction du numéro du mois

        $moisDateNDF = "";

        switch($dateNDF[1]){
            case "01";
            $moisDateNDF = "janvier";
            break;
            case "02";
            $moisDateNDF = "février";
            break;
            case "03";
            $moisDateNDF = "mars";
            break;
            case "04";
            $moisDateNDF = "avril";
            break;
            case "05";
            $moisDateNDF = "mai";
            break;
            case "06";
            $moisDateNDF = "juin";
            break;
            case "07";
            $moisDateNDF = "juillet";
            break;
            case "08";
            $moisDateNDF = "août ";
            break;
            case "09";
            $moisDateNDF = "septembre";
            break;
            case "10";
            $moisDateNDF = "octobre";
            break;
            case "11";
            $moisDateNDF = "novembre";
            break;
            case "12";
            $moisDateNDF = "décembre";
            break;
        };


 $dateNDFpourPDFetVISU = $moisDateNDF." ".$dateNDF[0];



        // - On load le PDF grace a DOMPDF

        $pdf = PDF::loadView('pdf.PDFnotesdefrais', compact(["utilisateurs","dateNDFpourPDFetVISU","infosNDF"]))->setPaper('a4','landscape');

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
