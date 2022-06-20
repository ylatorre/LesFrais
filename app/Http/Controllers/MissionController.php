<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Missions;
use Illuminate\Support\Str;
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
        $event = Event::paginate(30);
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
        $events = new Event;
        $events->id = Str::uuid();
        
        $events->mission = $request->input('mission');
        $events->client = $request->input('client');
        $events->ville = $request->input('ville');
        $events->code_postal = $request->input('code_postal');
        $events->peage = $request->input('peage');
        $events->parking = $request->input('parking');
        $events->divers = $request->input('divers');
        $events->repas = $request->input('repas');
        $events->hotel = $request->input('hotel');
        $events->km = $request->input('km');


        $events->save();
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
