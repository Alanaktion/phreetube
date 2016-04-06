<?php
$router = App::router();

// Index
$router->route('GET /', 'Controller\\Index->index');
$router->route('GET /new', 'Controller\\Index->new');
$router->route('GET /top', 'Controller\\Index->top');
$router->route('GET /search', 'Controller\\Index->search');

// Video
$router->route('GET /v/@slug', 'Controller\\Video->view');
