<?php

namespace App\View\Components\Admin\Headers;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DropdownItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $label,
        public string $httpMethod = 'GET',
        public ?string $url = null,
        public ?string $svgUrl = null,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.headers.dropdown-item');
    }
}
