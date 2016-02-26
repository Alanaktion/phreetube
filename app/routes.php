<?php

$router = App::router();

// Index
$router->route('GET /', 'Controller\\Index->index');
