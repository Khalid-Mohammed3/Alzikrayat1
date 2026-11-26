<?php

// Start Session
session_start();

// Load Core Files
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Model.php';

// Create Router Object
$router = new Router();

// Home Page
$router->add('GET','/alzikrayat/public/', ['HomeController','index']);

$router->add('GET','/alzikrayat/public/about', ['HomeController','about']);

// Register Routes
$router->add(
    'GET',
    '/alzikrayat/public/register',
    ['AuthController', 'register']
);

$router->add(
    'POST',
    '/alzikrayat/public/register/store',
    ['AuthController', 'store']
);

// Login Routes
$router->add(
    'GET',
    '/alzikrayat/public/login',
    ['AuthController', 'login']
);

$router->add(
    'POST',
    '/alzikrayat/public/login/authenticate',
    ['AuthController', 'authenticate']
);

// Logout Route
$router->add(
    'GET',
    '/alzikrayat/public/logout',
    ['AuthController', 'logout']
);

// Photo Routes

$router->add(
    'GET',
    '/alzikrayat/public/gallery',
    ['PhotoController', 'index']
);

$router->add(
    'GET',
    '/alzikrayat/public/upload',
    ['PhotoController', 'uploadForm']
);

$router->add(
    'POST',
    '/alzikrayat/public/upload/store',
    ['PhotoController', 'store']
);

$router->add(
    'GET',
    '/alzikrayat/public/photo/{id}',
    ['PhotoController', 'show']
);

$router->add(
    'POST',
    '/alzikrayat/public/photo/{id}/delete',
    ['PhotoController', 'delete']
);

// Comment Routes

$router->add(
    'POST',
    '/alzikrayat/public/photo/{id}/comment',
    ['CommentController', 'store']
);

$router->add(
    'POST',
    '/alzikrayat/public/comment/{id}/delete',
    ['CommentController', 'delete']
);

// Dispatch Request
$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);