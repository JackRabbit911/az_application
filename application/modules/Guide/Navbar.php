<?php

namespace Modules\Guide;

use Sys\Template\Component;

class Navbar extends Component
{
    public function render()
    {
        $file = __DIR__ . '/data/navbar.php';

        $data = [
            'menu' => require $file,
            'brand' => 'Userguide',
        ];

        return view('@guide/navbar', $data);
    }
}
