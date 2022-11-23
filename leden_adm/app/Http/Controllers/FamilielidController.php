<?php

namespace App\Http\Controllers;

use App\Models\Familielid;
use App\Models\Soortlid;
use Illuminate\Http\Request;

// TEST
use App\Http\Controllers\SoortlidController;
use App\Http\Controllers\ContributieController;

class FamilielidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('familielid.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('familielid.create');
    }
    
    // EXTRA METHODS
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function date_format($datum)
    {
        //convert y-m-d to d-m-y
        $new_format = date("d-m-Y", strtotime($datum));
        return $new_format;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->authorize('create', Familielid::class);
        
        $validatedData = $request->validate([
            'naam' => 'required|string|max:255',
            'geboortedatum' => 'required|date',
            'familie_id' => 'required|integer',
            'soortlid' => 'nullable|string'
        ]);
        
        //convert y-m-d to d-m-y
        $geb_datum = $request->get('geboortedatum');
        $validatedData['geboortedatum'] = $this->date_format($geb_datum);
        
        $lid = Familielid::create($validatedData);
        
        return redirect(route('familie.show', ['familie' => $lid->familie_id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Familielid  $familielid
     * @return \Illuminate\Http\Response
     */
    public function show(Familielid $familielid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Familielid  $familielid
     * @return \Illuminate\Http\Response
     */
    public function edit(Familielid $familielid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Familielid  $familielid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Familielid $familielid)
    {   
        $this->authorize('update', $familielid);
        
        $validatedData = $request->validate([
            'naam' => 'required|string|max:255',
            'geboortedatum' => 'required|date',
            'soortlid' => 'nullable|string'
        ]);
        
        $new_geboortedatum = $request->get('geboortedatum');
        //convert y-m-d to d-m-y
        $new_geboortedatum = $this->date_format($new_geboortedatum);
        
        $validatedData['geboortedatum'] = $new_geboortedatum;
        $familielid->update($validatedData);
        $familielid->refresh();
        
//         $test = $familielid->lidContributie;
        
        //update leeftijd
        if ($familielid->lidContributie) {
            $leeftijd = date("Y")-substr($familielid->geboortedatum,6,4);
            $familielid->lidContributie->leeftijd = $leeftijd;
            $familielid->push();
        }
        
        //TODO - BUG - fixen werk niet meer.
//         if ($geboortedatum !== $new_geboortedatum) {
//             //pass leeftijd aan in contributietabel voor dit familielid
//             $contributie_leeftijd = new ContributieController();
//             $new_leeftijd = $contributie_leeftijd->bereken_leeftijd($new_geboortedatum);
//             $familielid->soortleden->contributies->leeftijd = $new_leeftijd;
//             $familielid->push();
//         }
       
        
        //og
//         $fam_id = $familielid->familie_id;
//         $geboortedatum = $familielid->geboortedatum;
//         $new_geboortedatum = $request->get('geboortedatum');
        
//         $familielid->naam = $request->get('naam');
        
//         if ($geboortedatum !== $new_geboortedatum) {
//             $familielid->geboortedatum = $new_geboortedatum;   
//             // update leeftijd in contributie table
//             // leeftijd berekenen TODO add bereken leeftijd in contributie controller or pass new geboortejaar to contrib controller for process
// //             $lid_jaar = substr($new_geboortedatum,6,4);
// //             $jaar = date("Y");
// //             $new_leeftijd = $jaar - $lid_jaar;
//             $contributie_leeftijd = new ContributieController();
//             $new_leeftijd = $contributie_leeftijd->bereken_leeftijd($new_geboortedatum);
//             $familielid->soortleden->contributies->leeftijd = $new_leeftijd;
//             $familielid->push();
//         }
        
//         $familielid->save();
//         $familielid->refresh();
        
        return redirect(route('familie.show', ['familie' => $familielid->familie_id]));
//            return view('components.helo', ['test' => $test]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Familielid  $familielid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Familielid $familielid)
    {   
        $this->authorize('delete', $familielid);
        
        $fam_id = $familielid->familie_id;
        $familielid->delete();

        return redirect(route('familie.show', ['familie' => $fam_id]));      

        
    }
}
