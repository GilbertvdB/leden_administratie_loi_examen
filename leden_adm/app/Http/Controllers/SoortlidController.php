<?php

namespace App\Http\Controllers;

use App\Models\Soortlid;
use Illuminate\Http\Request;

use App\Http\Controllers\ContributieController;


class SoortlidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('soortlid.index');
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

    /** TEST METHOD
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add($collection)
    {   
        $this->authorize('create', Soortlid::class);
        
        $lid = $collection;
        //send soortlid and familie id to soortlid.store;
        $soort = Soortlid::create([
            'familielid_id' => $lid->id,
            'omschrijving' => $lid->soortlid
        ]);
        
//         $contributie = new ContributieController();
//         $contributie->add($lid);
    }
        
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = Soortlid::create([
            'familielid_id' => $request->get('familielid_id'),
            'omschrijving' => $request->get('omschrijving')
        ]);
        
        return redirect('/leden');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Soortlid  $soortlid
     * @return \Illuminate\Http\Response
     */
    public function show(Soortlid $soortlid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Soortlid  $soortlid
     * @return \Illuminate\Http\Response
     */
    public function edit(Soortlid $soortlid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Soortlid  $soortlid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Soortlid $soortlid)
    {
        $this->authorize('update', $soortlid);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Soortlid  $soortlid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Soortlid $soortlid)
    {
        //
    }
}
