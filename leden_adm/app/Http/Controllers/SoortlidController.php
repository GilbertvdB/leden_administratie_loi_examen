<?php

namespace App\Http\Controllers;

use App\Models\Soortlid;
use Illuminate\Http\Request;


class SoortlidController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Familielid  $familielid
     * @return \Illuminate\Http\Response
     */
    public function add(Familielid $familielid)
    {   
        $this->authorize('create', Soortlid::class);
        
        $lid = $familielid;
 
        $soort = Soortlid::create([
            'familielid_id' => $lid->id,
            'omschrijving' => $lid->soortlid
        ]);
    }
}
