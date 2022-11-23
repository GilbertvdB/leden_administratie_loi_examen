<?php

namespace App\View\Components;

use App\Http\Controllers\FamilieController;
use Illuminate\View\Component;
use App\Models\Familielid;
use App\Models\Familie;
use Illuminate\Support\Facades\DB;

class Famdisplay extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.famdisplay');
    }
    
        
    public function leden()
    {
        return Familielid::all();
        
    }
    
    public function fam_leden()
    {
        $users = DB::table('families')
        ->join('familielids', 'families.id', '=', 'familielids.familie_id')
        ->select('families.naam AS familie', 'families.adres', 'familielids.naam')
        ->get();
        
        return $users;
    }
    
    // TODO display using relationship models ie famiilelid->naam->bedrag bv
    public function fam_contributies_info()
    {
        
        $users = DB::table('families')
        ->leftjoin('familielids', 'families.id', '=', 'familielids.familie_id')
        ->leftjoin('contributies', 'familielids.id', '=', 'contributies.familielid_id')
        ->select('families.id', 'families.naam AS familie', 'families.adres', 'familielids.naam', 'familielids.geboortedatum','familielids.soortlid', 'contributies.bedrag')
        ->get();
        
        return $users;

    }
    
}
