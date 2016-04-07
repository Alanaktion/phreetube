<?php
$router = App::router();

// Index
$router->route('GET /', 'Controller\\Index->index');
$router->route('GET /new', 'Controller\\Index->latest');
$router->route('GET /top', 'Controller\\Index->top');
$router->route('GET /search', 'Controller\\Index->search');

// Video
$router->route('GET /v/@slug', 'Controller\\Video->view');

// User
$router->route('GET /login', 'Controller\\User->login');
$router->route('POST /login', 'Controller\\User->loginPost');
$router->route('GET /signup', 'Controller\\User->signup');
$router->route('POST /signup', 'Controller\\User->signupPost');
$router->route('GET /u/@username', 'Controller\\User->view');
