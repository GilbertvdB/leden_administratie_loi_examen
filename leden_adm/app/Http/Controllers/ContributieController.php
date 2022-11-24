<?php

namespace App\Http\Controllers;

use App\Models\Contributie;
use App\Models\Familielid;
use Illuminate\Http\Request;

use App\Http\Controllers\BoekjaarController;
use App\Http\Controllers\SoortlidController;
use Illuminate\Support\Facades\DB;

class ContributieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contributie.create');
    }
    
    public function bereken_leeftijd($geboortedatum)
    {
        $lid_jaar = substr($geboortedatum,6,4);
        $jaar = date("Y");
        $leeftijd = $jaar - $lid_jaar;
        
        return $leeftijd;
    }
    
    public function bepaal_soortlid($leeftijd)
    {
        
        switch ($leeftijd) {
            case ($leeftijd < 8):
                $soortlid = 'Jeugd';
                break;
            case ($leeftijd < 13):
                $soortlid = 'Aspirant';
                break;
            case ($leeftijd < 18):
                $soortlid = 'Junior';
                break;
            case ($leeftijd < 51):
                $soortlid = 'Senior';
                break;
            case ($leeftijd >= 51):
                $soortlid = 'Oudere';
                break;
        }
        
        return $soortlid;
    }
    
    public function bereken_bedrag($soortlid)
    {
        // contributie bedrag
        $basis_contributie = 100;
        
        switch ($soortlid) {
            case ($soortlid == 'Jeugd'):
                $korting = 50/100;
                break;
            case ($soortlid == 'Aspirant'):
                $korting = 40/100;
                break;
            case ($soortlid == 'Junior'):
                $korting = 25/100;
                break;
            case ($soortlid == 'Senior'):
                $korting = 0/100;
                break;
            case ($soortlid == 'Oudere'):
                $korting = 45/100;
                break;
        }
        
        $bedrag = $basis_contributie - ($basis_contributie * $korting);
        
        return $bedrag;
    }
    /** TEST METHOD
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add($collection)
    {   $this->authorize('create', Contributie::class);
        
        $lid = $collection;
        
    // Berekeningen
    $leeftijd = $this->bereken_leeftijd($lid->geboortedatum);
    
    $bedrag = $this->bereken_bedrag($this->bepaal_soortlid($leeftijd));
    
    //create table
    $contributie = Contributie::create([
        'familielid_id' => $lid->id,
        'soortlid' => $lid->soortlid,
        'leeftijd' => $leeftijd,
        'bedrag' => $bedrag
    ]);
    
    //TEST!! TODO - WORKS!!
    //request test - sending data to other controller for process
    // add controller to the list & call controller function
    $boekjaar = new BoekjaarController();
    $boekjaar->add($contributie);
    
    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = Contributie::create([
	'familielid_id' => $request->get('familielid_id'),
            'soortlid' => $request->get('soortlid'),
            'leeftijd' => $request->get('leeftijd'),
            'bedrag' => $request->get('bedrag')
        ]);
        
        return redirect('/leden');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contributie  $contributie
     * @return \Illuminate\Http\Response
     */
    public function show($fam_id)
    {
        $familieLeden = DB::table('families')
        ->leftjoin('familielids', 'families.id', '=', 'familielids.familie_id')
        ->leftjoin('contributies', 'familielids.id', '=', 'contributies.familielid_id')
        ->select('families.naam as familie','familielids.id as l_id','familielids.naam', 'familielids.geboortedatum','familielids.soortlid', 'contributies.id','contributies.soortlid as soort','contributies.leeftijd','contributies.bedrag')
        ->where('families.id', $fam_id)
        ->get();
        
        
        $famNaam = $familieLeden->pluck('familie');
        
        // reverse lookup - als er een contributie bestaat - nvt wanneer de soortlid null  is.
//         $data = Contributie::find(6);
//         $soort = $data->soortleden[0]->familielid->soortlid;
//         $bedrag = $data->bedrag;
        
        
        return view('contributies')
//         ->with('test', $soort)
//         ->with('bedrag', $bedrag)
        ->with('fam_leden', $familieLeden)
        ->with('fam_id', $fam_id)
        ->with('fam_naam', $famNaam[0]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contributie  $contributie
     * @return \Illuminate\Http\Response
     */
    public function edit(Contributie $contributie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contributie  $contributie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $fam_id)
    {   
        $this->authorize('update', Contributie::class);
        
        $validatedData = $request->validate([
            'soortlid' => 'required|string',
            'bedrag' => 'required_with:id|integer'
        ]);
        
        $l_id = $request->get('familielid_id');
        $id = $request->get('id');
        $new_soortlid = $request->get('soortlid');
        $lid = Familielid::find($l_id);
        $lid_contributie = Contributie::find($id);
        
        if ($lid->soortlid) {
            $lid_contributie->update($validatedData);
            
            // update soortlid in familielid en soortlids tabel
            $lid->soortlid = $new_soortlid;
            $lid->soortleden->omschrijving = $new_soortlid;
            
            $lid->push();
        }
        // indien leeg create entry - TODO simplefy
        else {
            $lid->soortlid = $new_soortlid;
            $lid->save();
            $lid->refresh();
            // autocreate table entries contributies and soortlid
            $this->add($lid);
            $soort = new SoortlidController();
            $soort->add($lid);
            
                // using request and store
//             $request->mergeIfMissing(['omschrijving' => $new_soortlid]);
//             $soort->store($request);
        }
            
        return $this->show($fam_id);
            // TODO save and refresh model
//         $table = $lid->soortleden;
//         return view('components.helo')
// //         ->with ('data', $huidig_bedrag)
//         ->with ('contributie_id',$id)
//         ->with ('l_id',$l_id)
//         ->with ('soort', $new_soortlid)
//         ->with ('s_table', $table);
        

//  Reverese lookup via contributie        
//         $data = Contributie::find(6);
//         $soort = $data->soortleden[0]->familielid->soortlid;
//         $bedrag = $data->bedrag;
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contributie  $contributie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contributie $contributie)
    {
        //
    }
}