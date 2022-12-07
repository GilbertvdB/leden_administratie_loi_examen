<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Boekjaar;

class Boekjaar_selection extends Component
{   
    /**
     * The year.
     *
     * @var string
     */
    public $jaren_info;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($jaren_info)
    {
        $this->jaren_info = $jaren_info;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.boekjaar_selection');
    }
    
    public function jaren_info() {
        $bk = Boekjaar::all();
        $jaren_info = $bk->pluck('jaar')->unique()->values();
        
        return $jaren_info;
    }
}
