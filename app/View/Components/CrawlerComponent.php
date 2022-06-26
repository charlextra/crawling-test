<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CrawlerComponent extends Component
{
    private $crawlers;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($crawlers)
    {
        $this->crawlers = $crawlers;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $crawlers = $this->crawlers;
        return view('components.crawler-component', compact('crawlers'));
    }
}
