<?php

namespace App\Http\Controllers;

use App\Models\Personne;
use Illuminate\Http\Request;

class PersonneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  Personne::all();
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
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Personne::find($id);
    }

    public function allPersonne()
    {
        return Personne::all();
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
        // $personne = Personne::find($id);
        // if ($personne) {
        //     $personne->update([
        //         'civilite' => $request->civilite,
        //         'nom' => $request->nom,
        //         'prenom' => $request->prenom,
        //         'telephone' => $request->telephone,
        //         'adress' => $request->adress,
        //         'disponibilite' => $request->disponibilite,
        //     ]);
        //     return response()->json([
        //         'success' => 'Personne modifiée avec success',
        //     ], 200);
        // }
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
        $personne = Personne::find($id);
        if ($personne) {
            $personne->delete();
            return response()->json([
                'success' => 'Personne supprimée avec success',
            ], 200);
        }
    }
}
