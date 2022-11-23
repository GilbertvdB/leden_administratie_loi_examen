<?php

namespace App\Http\Controllers;

use App\Models\Adres;
use Illuminate\Http\Request;

class AdresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//         return 'Hello Adres';
        return view('adres.index');
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
        $validated = $request->validate([
            
            'adres' => 'required|string|max:255',
            
        ]);
        
        
        
        $request->user()->adres()->create($validated);
        
        
        
        return redirect(route('adres.index'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adres  $adres
     * @return \Illuminate\Http\Response
     */
    public function show(Adres $adres)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adres  $adres
     * @return \Illuminate\Http\Response
     */
    public function edit(Adres $adres)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Adres  $adres
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adres $adres)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adres  $adres
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adres $adres)
    {
        //
    }
}
