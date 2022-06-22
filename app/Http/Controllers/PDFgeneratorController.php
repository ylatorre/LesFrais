<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PDFgeneratorController extends Controller
{
    public function PDFgenerator(Request $request)
    {

        $utilisateurs = DB::table('users')->get();



        // $date = 0;
        // $moisencours = Carbon::createFromFormat("m/d/Y");

            $pdf = PDF::loadView('pdf.PDFnotesdefrais',compact("utilisateurs"));
            return $pdf->stream('pdf.PDFnotesdefrais'.'.pdf');


    }
}
