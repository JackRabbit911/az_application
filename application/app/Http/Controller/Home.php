<?php

namespace App\Http\Controller;

// use App\Component\Navbar;
// use Auth\Component\ProfileForm;
// use Az\Route\Route;
// use Nette\Utils\FileInfo;
use Sys\Controller\WebController;
// use Sys\SimpleRequest;
// use Sys\Template\App;
// use Sys\Config\Config;
// use Sys\Form\Form;

final class Home extends WebController 
{
    public function __invoke()
    {
        // return $this->redirect(path('guide'));
        return view('home', ['h1' => 'Homepage']);
    }

    public function item(?string $param = null)
    {
        $h1 = match ($param) {
            'i1' => 'Sub Item 1',
            'i2' => 'Sub Item 2',
            'i3' => 'Sub Item 3',
            default => 'Item',
        };

        return view('home', ['h1' => $h1]);
    }

    public function about($action)
    {
        return view('home', ['h1' => $action]);
    }

    public function search($action)
    {
        return view('home', ['h1' => $action]);
    }

    public function news($action)
    {
        return view('home', ['h1' => $action]);
    }
}
