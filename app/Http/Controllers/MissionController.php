<?php

namespace App\Http\Controllers;

use App\Models\Missions;
use Illuminate\Http\Request;
use App\Exports\MissionExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreMissionRequest;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $missions = Missions::paginate(30);
        return view('mission.index', compact('missions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMissionRequest $request)
    {
        $mission = new Missions;
        $mission->mission = $request->input('mission');
        $mission->client = $request->input('client');
        $mission->ville = $request->input('ville');
        $mission->code_postal = $request->input('code_postal');
        $mission->peage = $request->input('peage');
        $mission->parking = $request->input('parking');
        $mission->divers = $request->input('divers');
        $mission->repas = $request->input('repas');
        $mission->hotel = $request->input('hotel');
        $mission->km = $request->input('km');


        $mission->save();
        return redirect('mission.index')->with('success', 'Data submited successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function get_student_data()
    {
        return Excel::download(new MissionExport, 'students.xlsx');
    }
}
