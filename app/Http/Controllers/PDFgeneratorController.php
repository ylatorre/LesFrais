<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
