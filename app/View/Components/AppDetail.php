<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\App;

class AppDetail extends Component
{
    public $app;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.app-detail');
    }
}
