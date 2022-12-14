<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DeleteForm-modal extends Component
{   
    
    /**
     * The destroy route.
     *
     * @var string
     */
    public $action;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action)
    {
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.delete-form-modal');
    }
}
