<?php

namespace App\Http\Controllers;

use App\Models\Boekjaar;

use Illuminate\Http\Request;

class BoekjaarController extends Controller
{
        
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Contributie  $contributie
     * @return \Illuminate\Http\Response
     */
    public function add($contributie)
    {   
        $this->authorize('create', Boekjaar::class);
        
        $id = $contributie->id;
        $jaar = date("Y");
        
        $store = Boekjaar::create([
            'contributie_id' => $id,
            'jaar' => $jaar
        ]);
    }
}
