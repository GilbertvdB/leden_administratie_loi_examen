<?php

namespace App\Http\Controllers;

use App\Models\Familie;
use Illuminate\Http\Request;

class FamilieController extends Controller
{   
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//         $this->authorizeResource(Familie::class, 'store');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//         return view('familie.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//         return view('familie.create');  as component/include in fam edit?
        return view('famedit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->authorize('create', Familie::class);
        
        $validatedData = $request->validate([
            'naam' => 'required|string|max:255',
            'adres' => 'required|string|max:255'
        ]);
    
        $store = Familie::create($validatedData);
 
        return view('/famedit', ['fam' => $store]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Familie  $familie
     * @return \Illuminate\Http\Response
     */
//     public function show(Familie $familie)
    public function show($familie)
    {
        $fam_data = Familie::find($familie);
        $leden_data = Familie::find($familie)->familieLeden;
        
        return view('/famedit')
        ->with(['fam' => $fam_data])
        ->with(['leden' => $leden_data]);
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Familie  $familie
     * @return \Illuminate\Http\Response
     */
    public function edit(Familie $familie)
    {
        //         return view('familie.edit');  as component/include in famedit?
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Familie  $familie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Familie $familie)
    {   
        $this->authorize('update', $familie);
        
        $validatedData = $request->validate([
            'naam' => 'required|string|max:255',
            'adres' => 'required|string|max:255'
        ]);
        
        $familie->update($validatedData);
        
        return redirect(route('familie.show', $familie->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Familie  $familie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Familie $familie)
    {   
        $this->authorize('delete', $familie);
        
        $familie->delete();
        
        return redirect('/leden');
    }
}
