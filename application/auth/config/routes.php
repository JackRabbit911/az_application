<?php

use Auth\Controller\Auth;
use Auth\Controller\ChangePassword;
use Auth\Controller\Profile;
use Auth\Controller\Register;
use Auth\Controller\Restore;
use Auth\Middleware\AuthMiddleware;
use Auth\Middleware\GuestGuardMiddleware;
use Auth\Middleware\AuthGuardMiddleware;
use Auth\Middleware\ProfileValidation;
use Az\Validation\Middleware\CsrfMiddleware;


$this->route->group('/auth', function () {
    
    $this->route->controller('/{action}', Auth::class, 'auth');
    $this->route->controller('/register/{action}/{code?}', Register::class, 'register');
    $this->route->controller('/restore/{action}/{code?}', Restore::class, 'restore');
    $this->route->controller('/restore/change/password/{action}', ChangePassword::class, 'restore.password');
    $this->route->pipe(AuthMiddleware::class, GuestGuardMiddleware::class, CsrfMiddleware::class);
    $this->route->methods('get')->allowAttribute(true);
});

$this->route->group('/private', function () {
    $this->route->get('/profile', [Profile::class, 'showForm'], 'profile');
    $this->route->post('/profile/save', [Profile::class, 'save'], 'profile.save')
        ->pipe(ProfileValidation::class);
    $this->route->controller('/change/password/{action}', ChangePassword::class, 'profile.password');
    $this->route->pipe(AuthMiddleware::class , AuthGuardMiddleware::class, CsrfMiddleware::class);
    $this->route->allowAttribute(true);
});
