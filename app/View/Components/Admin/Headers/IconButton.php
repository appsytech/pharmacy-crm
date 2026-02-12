<?php

namespace App\View\Components\Admin\Headers;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class IconButton extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $svgUrl,
        public ?string $url = null,

    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.headers.icon-button');
    }
}
