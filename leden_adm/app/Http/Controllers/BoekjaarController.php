<?php

namespace App\Http\Controllers;

use App\Models\Boekjaar;
use Illuminate\Http\Request;

class BoekjaarController extends Controller
{
    
    public $jaar;
    
    public function set_boekjaar()
    {
        $this->jaar = 2022;
    }
    
    public function update_boekjaar(Request $request)
    {
        $jaar = $request->get('jaar');
        $this->jaar = $jaar;
        
        return back()->with('jaar', $jaar);
    }
    
    public function get_boekjaar()
    {
        return $this->jaar;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('boekjaar.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('boekjaar.create');
    }

    /** TEST METHOD
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add($collection)
    {   
        $this->authorize('create', Boekjaar::class);
        
        $id = $collection->id;
        $jaar = date("Y");
        
        $store = Boekjaar::create([
            'contributie_id' => $id,
            'jaar' => $jaar
        ]);
        
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	
        $this->authorize('create', Contributie::class);
        
        $store = Boekjaar::create([
	    'contributie_id' => $request->get('contributie_id'),
            'jaar' => $request->get('jaar')
        ]);
        
        return redirect('/test');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Boekjaar  $boekjaar
     * @return \Illuminate\Http\Response
     */
    public function show(Boekjaar $boekjaar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Boekjaar  $boekjaar
     * @return \Illuminate\Http\Response
     */
    public function edit(Boekjaar $boekjaar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Boekjaar  $boekjaar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Boekjaar $boekjaar)
    {
        $this->authorize('update', $boekjaar);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Boekjaar  $boekjaar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Boekjaar $boekjaar)
    {
        //
    }
}
