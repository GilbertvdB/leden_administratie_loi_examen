<?php

namespace App\Http\Controllers;

use App\Models\Familielid;
use Illuminate\Http\Request;

class FamilielidController extends Controller
{   
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zoek_term = request('search');
        $leden = Familielid::where('naam', 'like', '%'.$zoek_term.'%')->orderBy('naam', 'asc')->simplePaginate(10);
        
        return view('familielid.index', compact('leden'))->with('zoekterm', $zoek_term);
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
        
        $new_lid = Familielid::create($validatedData);
        
        return redirect(route('familie.show', ['familie' => $new_lid->familie_id]));
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
        
        //convert y-m-d to d-m-y
        $new_geboortedatum = $request->get('geboortedatum');
        $new_geboortedatum = $this->date_format($new_geboortedatum);
        
        $validatedData['geboortedatum'] = $new_geboortedatum;
        $familielid->update($validatedData);
        $familielid->refresh();
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Familielid  $familielid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $familielid)
    {   
        $this->authorize('delete', Familielid::class);
        $id = $request->get('user-id');
        $famlid = Familielid::find($id);
        $famlid->delete();

        return back(); 
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
        $zoek_term = request('search');
        return redirect()->route('familielid.index', ['search' => $zoek_term]);
    }
    
    /**
     * Convert date format from y-m-d to d-m-y.
     * @param  date  $datum
     * @return date in new format
     */
    protected function date_format($datum)
    {
        $new_format = date("d-m-Y", strtotime($datum));
        return $new_format;
    }
}
