<?php

namespace App\View\Components\Admin\Globals\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormSecondary extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.globals.forms.form-secondary');
    }
}
