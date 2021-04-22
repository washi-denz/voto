<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SubTitle extends Component
{   
    public $content1;
    public $content2;

    public function __construct($content1 = '',$content2 = '')
    {
        $this->content1 = $content1;
        $this->content2 = $content2;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sub-title');
    }
}
