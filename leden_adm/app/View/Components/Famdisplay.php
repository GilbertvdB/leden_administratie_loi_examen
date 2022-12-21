<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Famdisplay extends Component
{   
    
    public $info;
    public $zoekterm;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($info, $zoekterm)
    {
        $this->info = $info;
        $this->zoekterm = $zoekterm;
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
    
}
