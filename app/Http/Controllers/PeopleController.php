<?php

namespace App\Http\Controllers;

use App\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peoples = People::all();
        return view('manage.people.index')->with('peoples',$peoples);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $person)
    {
        $person->validate([
            'name'       => 'required|max:255',
            'height' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'lactose' => 'required|boolean',
            'weight' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'athlete' => 'required|boolean',
          ]);

          $people = People::updateOrCreate(['id' => $person->id], [
                    'name' => $person->name,
                    'height' => $person->height,
                    'lactose' => $person->lactose,
                    'weight' => $person->weight,
                    'athlete' => $person->athlete
                  ]);

          return response()->json(['code'=>200, 'message'=>'People Created successfully','data' => $people], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function show(People $person)
    {
        $people = People::find($person);

        return response()->json($people);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function edit(People $people)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, People $people)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy(People $person)
    {
        $people = People::find($person);
        dd($people);
        exit;

        return response()->json(['success'=>'People Deleted successfully']);
    }
}
