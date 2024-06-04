<?php

namespace App\Component;

use Sys\Template\Component;

class Navbar extends Component
{
    private $config;
    private $brand;

    public function __construct($config = 'navbar', $brand = 'Brand')
    {
        $prefix = 'data/navbar/';
        $config = $prefix . $config;
        $this->config = $config;
        $this->brand = $brand;
    }

    public function render()
    {
        $data = [
            'menu' => config($this->config),
            'brand' => $this->brand,
        ];

        return view('navbar', $data);
    }
}
