<?php

namespace App\View\Components\Admin\Sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

class NavItem extends Component
{

    public bool $isActive;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public ?string $url = null,
        public ?string $svgUrl =  null,
        public array $activeRoutes = []
    ) {
        $this->isActive = $this->checkIsActive();
    }


    protected function checkIsActive(): bool
    {
        return collect($this->activeRoutes)
            ->contains(fn($route) => Route::currentRouteNamed($route));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.sidebar.nav-item');
    }
}
