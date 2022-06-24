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

        $utilisateurs = DB::table('users')->RightJoin("events","events.idUser","users.id")->where("idUser", "=", Auth::user()->id)->get();
// dd($utilisateurs);


        // $date = 0;
        // $moisencours = Carbon::createFromFormat("m/d/Y");

            $pdf = PDF::loadView('pdf.PDFnotesdefrais',compact("utilisateurs"))->setPaper('a4', 'landscape');
            return $pdf->stream('pdf.PDFnotesdefrais'.'.pdf');


    }
}
