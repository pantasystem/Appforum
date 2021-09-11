<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Markdown extends Component
{
    public $html;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $text)
    {
        $parser = new \Parsedown();
        $parser->setSafeMode(true);
        $this->html = $parser->text($text ?? '');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.markdown');
    }
}
