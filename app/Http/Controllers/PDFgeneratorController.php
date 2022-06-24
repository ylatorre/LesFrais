<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PDFgeneratorController extends Controller
{
    public function PDFgenerator(Request $request)
    {
//    dd($request->query("mois"));
        $debutMois = Carbon::createFromFormat('Y-m-d',$request->query("mois")."-"."01");
        $FinMois = Carbon::createFromFormat('Y-m-d',$request->query("mois")."-"."01")->addMonth(1)->subSecond(1);
//        dd($debutMois);

        $utilisateurs = DB::table('users')->RightJoin("events","events.idUser","users.id")->where("idUser", "=", Auth::user()->id)->RightJoin("historique_essences","historique_essences.userId","users.id")->whereBetween("end",[$debutMois,$FinMois])->get();
 dd($utilisateurs);


        // $date = 0;
        // $moisencours = Carbon::createFromFormat("m/d/Y");

            $pdf = PDF::loadView('pdf.PDFnotesdefrais',compact("utilisateurs"))->setPaper('a4', 'landscape');
            return $pdf->stream('pdf.PDFnotesdefrais'.'.pdf');


    }
}
