<?php

namespace App\View\Components;

use Illuminate\View\Component;


class Chirp extends Component
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
        return <<<'blade'
<div {{ $attributes }} >
    <!-- The whole future lies in uncertainty: live immediately. - Seneca -->
    This is a rendered Inline component. No view needed.
</div>
blade;
    }
}
