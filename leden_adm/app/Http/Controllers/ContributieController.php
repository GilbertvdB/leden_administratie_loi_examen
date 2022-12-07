<?php

namespace App\Http\Controllers;

use App\Models\Contributie;
use App\Models\Familielid;
use App\Models\Soortlid;
use App\Models\Boekjaar;
use App\Models\Familie; // TODO delete
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
        //
    }

    /**
     * Display a listing of the specified resource.
     *
     * @param  Familie Id string  $familie_id
     * @return \Illuminate\Http\Response
     */
    public function show($familie_id)
    {
        $familieLeden = $this->db_info($familie_id);
        $famNaam = $familieLeden->pluck('familie');
        $incompleet_profiel = $this->check_profielen($familieLeden);
        
        // boekjaar contribution year record choices
        $bk = Boekjaar::all();
        $info = $bk->pluck('jaar')->unique()->values();
        
        return view('contributies')
        ->with('jaren_info', $info) //for boekjaar selection
        ->with('fam_leden', $familieLeden)
        ->with('incompleet', $incompleet_profiel)
        ->with('familie_id', $familie_id)
        ->with('familie_naam', $famNaam[0]);
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Familielid Id string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Contributie::class);
        $lid = Familielid::find($id);
        
        //incomplete profile check
        if ($lid->lidContributie) {
            $contrib = $lid->lidContributie;
        }
        else {$contrib = "";} // no contribution records yet created
        
        return view('contributie.edit')
        ->with(['lid' => $lid])
        ->with(['contributie' => $contrib]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Familielid Id string  $id
     * @return \Illuminate\Http\Response
     */    
    public function update(Request $request, $id)
    {
        $this->authorize('update', Contributie::class);
        
        $validatedData = $request->validate([
            'soortlid' => 'required|string',
            'bedrag' => 'required_with:id|integer'
        ]);
        
        $new_soortlid = $request->get('soortlid');
        $lid = Familielid::find($id);
        $lid_contributie = $lid->lidContributie; //fetch records
        
        // update existing records
        if ($lid->soortlid) {
            $lid_contributie->update($validatedData);
            
            // update soortlid in familielids and soortlids tabel
            $lid->soortlid = $new_soortlid;
            $lid->soortleden->omschrijving = $new_soortlid;
            $lid->push();
        }
        // create if no contribution records exist yet
        else {
            $lid->soortlid = $new_soortlid;
            $lid->save();
            $lid->refresh();
            
            // autocreate table entries in contributies and soortlids
            $this->add($lid);
            $soort = new SoortlidController();
            $soort->add($lid);
        }
        
        return redirect(route('contributie.show', $lid->familie_id));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  Contributie Id string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Contributie::class);
        $gegevens = Contributie::find($id);
        
        //delete boekjaar record
        $boekjaar = Boekjaar::find($gegevens->boekjaar->id);
        $boekjaar->delete();
        
        //delete soortlid record
        $soortlid = Soortlid::find($gegevens->soortleden[0]->id);
        $soortlid->delete();
        
        //set familielied soortlid column to null
        $gegevens->lidContributie->soortlid = null;
        $gegevens->push();
        
        //delete contribution record
        $gegevens->delete();
        
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Familielid  $familielid
     * @return \Illuminate\Http\Response
     */
    public function add(Familielid $familielid)
    {   
        $this->authorize('create', Contributie::class);
        $lid = $familielid;
        
        // calculations
        $leeftijd = $this->bereken_leeftijd($lid->geboortedatum);
        $bedrag = $this->bereken_bedrag($this->bepaal_soortlid($leeftijd));
        
        //create table
        $contributie = Contributie::create([
            'familielid_id' => $lid->id,
            'soortlid' => $lid->soortlid,
            'leeftijd' => $leeftijd,
            'bedrag' => $bedrag
    ]);
    
    // add new contribution to boekjaar table.
    $boekjaar = new BoekjaarController();
    $boekjaar->add($contributie);
    
    }
    
    
    protected function db_info($familie_id)
    {
        //joining familie, familielid, contributie & boekjaar table.
        $all_info = DB::table('families')
        ->leftjoin('familielids', 'families.id', '=', 'familielids.familie_id')
        ->leftjoin('contributies', 'familielids.id', '=', 'contributies.familielid_id')
        ->leftjoin('boekjaars', 'boekjaars.contributie_id', '=', 'contributies.id')
        ->select('families.naam as familie','familielids.id as lid_id','familielids.naam', 'familielids.geboortedatum','familielids.soortlid', 'contributies.id','contributies.soortlid as soort','contributies.leeftijd','contributies.bedrag', 'boekjaars.jaar')
        ->where('families.id', $familie_id)
        ->get();
        
        return $all_info;   
    }
    
    protected function check_profielen($familieLeden) {
        // return all familielids with no contribution record
        $incompleet_profielen = $familieLeden->where('id', null);
        // return empty collection if familie has no familielids yet
        if (!$incompleet_profielen->pluck('lid_id')->first()) {
            $incompleet_profielen = collect();
        }
        
        return $incompleet_profielen;
    }
    
    /**
     * Update user chosen date
     * and returns the result.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function update_boekjaar(Request $request)
    {   
        $validated = $request->validate([
            'jaar' => 'required|string',
        ]);
        
        $jaar = $request->get('jaar');
        
        return back()->with('jaar', $jaar);
    }
    
    /**
     * Calculates max age and
     * returns result.
     * 
     * @param  Birthyear string $geboortedatum
     * @return Age string $leeftijd
     */
    protected function bereken_leeftijd($geboortedatum)
    {
        $lid_jaar = substr($geboortedatum,6,4);
        $jaar = date("Y"); //current year
        $leeftijd = $jaar - $lid_jaar;
        
        return $leeftijd;
    }
    
    
    /**
     * Assigns a membership based 
     * on the age and returns the result.
     *
     * @param  Age string $leeftijd
     * @return Membership string $soortlid
     */
    protected function bepaal_soortlid($leeftijd)
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
    
    /**
     * Calculates the contribution based on the
     * type of membership and return the result.
     *
     * @param  Membership string $soortlid
     * @return Contribution string $bedrag
     */
    protected function bereken_bedrag($soortlid)
    {
        // contributie ammount
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
}
