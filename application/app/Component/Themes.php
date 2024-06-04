<?php

namespace App\Component;

use Sys\Template\Component;

class Themes extends Component
{
    public function render()
    {
        return view('themes', ['themes' => config('themes')]);
    }
}
