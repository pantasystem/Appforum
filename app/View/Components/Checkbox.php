<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class Checkbox extends Component
{
    public $value;
    public $id;
    public $name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name, $value)
    {
        $this->value = $value;
        $this->name = $name;
        $this->id = $name . Str::random(16);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.checkbox');
    }
}
