<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Familielid;
use App\Models\Familie;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return view('user.profile', [
            'user' => User::findOrFail($id)
        ]);
    }
    
    // TODO display using relationship models ie famiilelid->naam->bedrag bv
    public function info()
    {
        $search = '';

        $users = $this->db_info($search);
        
        return view('ledendash')->with(['info' => $users]);
        
    }
    
    public function search(Request $request)
    {
        
        $search = $request->get('search');
        
        $users = $this->db_info($search);
        
        return view('ledendash')->with(['info' => $users]);
        
    }
    
    
    public function db_info($search)
    {
        $info = DB::table('families')
        ->leftjoin('familielids', 'families.id', '=', 'familielids.familie_id')
        ->leftjoin('contributies', 'familielids.id', '=', 'contributies.familielid_id')
        ->select('families.id', 'families.naam AS familie', 'families.adres', 'familielids.naam', 'familielids.geboortedatum','familielids.soortlid', 'contributies.bedrag')
        ->where('families.naam', 'like', '%'.$search.'%') // display info search request
        ->orderBy('familie', 'asc')
        //         ->get();
        ->simplePaginate(10);
        
        return $info;
        
    }
    
    
    
}
