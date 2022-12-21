<?php

namespace App\Http\Controllers;

use App\Models\Familie;
use Illuminate\Http\Request;

class FamilieController extends Controller
{   
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request('search');
        $families_data = $this->db_info($search);

        return view('dashboard')
        ->with(['info' => $families_data])
        ->with(['zoekterm' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return one single show/create/edit page for Familie en Familielid.
        return view('/familieprofiel');
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
    
        $new_familie = Familie::create($validatedData);
 
        return redirect(route('familie.show', $new_familie->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  Familie id nummer  $familie
     * @return \Illuminate\Http\Response
     */
//     public function show(Familie $familie)
    public function show($familie)
    {
        $fam_data = Familie::find($familie);
        $leden_data = Familie::find($familie)->familieLeden;
        
        return view('/familieprofiel')
        ->with(['familie' => $fam_data])
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
        return view('familie.edit')->with('familie', $familie);
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
        
        return redirect(route('familie.show', $familie));
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
        
        return redirect('dashboard');
    }
    
    /**
     * Search the specified resource in storage
     * and return the result.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function search()
    {
        $searchTerm = request('search');
        return redirect()->route('familie.index', ['search' => $searchTerm]);
    }
    
    
    /**
     * Search the specified resource in storage
     * and return the result.
     * 
     * @param  Search string  $search
     * @return \Illuminate\Http\Response
     */
    protected function db_info($search)
    {
        $info = Familie::where('naam', 'like', '%'.$search.'%')->orderBy('naam', 'asc')->simplePaginate(10);

        return $info;
        
    }
}
