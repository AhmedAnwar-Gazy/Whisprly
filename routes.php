<?php

// $router->get('/', 'controlers/whisprly.php');

// $router->get('/about', 'controlers/about.php');

// $router->get('/contact', 'controlers/contact.php');

// $router->get('/notes', 'controlers/notes/index.php')->only('auth');

// $router->get('/note', 'controlers/notes/show.php')->only('auth');
// $router->delete('/note', 'controlers/notes/destroy.php');
// $router->delete('/note', 'controlers/notes/show.php');
// $router->patch('/note', 'controlers/notes/update.php');


// $router->get('/notes/Create', 'controlers/notes/create.php');
// $router->post('/notes/Create', 'controlers/notes/store.php');

// $router->get('/notes/edit', 'controlers/notes/edit.php');


$router->get('/register', 'controlers/registertion/create.php')->only('guest');
$router->post('/register', 'controlers/registertion/store.php');

$router->get('/login', 'controlers/sessions/create.php')->only('guest');
$router->delete('/logout', 'controlers/sessions/destroy.php')->only('auth');
$router->post('/login', 'controlers/sessions/store.php');



$router->get('/', 'controlers/whisprly.php');

$router->get('/about', 'controlers/about.php');

$router->get('/contact', 'controlers/contact.php');



$router->get('/admin/content_moderation', 'controlers/admin/content_moderation.php');
$router->get('/admin/category_management', 'controlers/admin/category_management.php');



$router->get('/creator/manage_my_content', 'controlers/creator/manage_my_content.php');
$router->get('/creator/creator_dashboard', 'controlers/creator/creator_dashboard.php');




$router->get('/book/create', 'controlers/book/create.php');
$router->get('/book/destroy', 'controlers/book/destroy.php');
$router->get('/book/edit', 'controlers/book/edit.php');
$router->get('/book/index', 'controlers/book/index.php');
$router->get('/book/list', 'controlers/book/list.php');
$router->get('/book/manage', 'controlers/book/manage.php');
$router->get('/book/show', 'controlers/book/show.php');
$router->get('/book/store', 'controlers/book/store.php');
$router->get('/book/update', 'controlers/book/update.php');



$router->get('/episode/create', 'controlers/episode/create.php');
$router->get('/episode/destroy', 'controlers/episode/destroy.php');
$router->get('/episode/edit', 'controlers/episode/edit.php');
$router->get('/episode/index', 'controlers/episode/index.php');
$router->get('/episode/list', 'controlers/episode/list.php');
$router->get('/episode/manage', 'controlers/episode/manage.php');
$router->get('/episode/show', 'controlers/episode/show.php');
$router->get('/episode/store', 'controlers/episode/store.php');
$router->get('/episode/update', 'controlers/episode/update.php');



$router->get('/podcast/create', 'controlers/podcast/create.php');
$router->get('/podcast/destroy', 'controlers/podcast/destroy.php');
$router->get('/podcast/edit', 'controlers/podcast/edit.php');
$router->get('/podcast/index', 'controlers/podcast/index.php');
$router->get('/podcast/list', 'controlers/podcast/list.php');
$router->get('/podcast/manage', 'controlers/podcast/manage.php');
$router->get('/podcast/show', 'controlers/podcast/show.php');
$router->get('/podcast/store', 'controlers/podcast/store.php');
$router->get('/podcast/update', 'controlers/podcast/update.php');
