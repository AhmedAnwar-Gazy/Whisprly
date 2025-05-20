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




$router->get('/book_create', 'controlers/book/create.php');
$router->get('/book_destroy', 'controlers/book/destroy.php');
$router->get('/book_edit', 'controlers/book/edit.php');
$router->get('/book_index', 'controlers/book/index.php');
$router->get('/book_list', 'controlers/book/list.php');
$router->get('/book_manage', 'controlers/book/manage.php');
$router->get('/book_show', 'controlers/book/show.php');
$router->get('/book_store', 'controlers/book/store.php');
$router->get('/book_update', 'controlers/book/update.php');



$router->get('/episode_create', 'controlers/episode/create.php');
$router->get('/episode_destroy', 'controlers/episode/destroy.php');
$router->get('/episode_edit', 'controlers/episode/edit.php');
$router->get('/episode_index', 'controlers/episode/index.php');
$router->get('/episode_list', 'controlers/episode/list.php');
$router->get('/episode_manage', 'controlers/episode/manage.php');
$router->get('/episode_show', 'controlers/episode/show.php');
$router->get('/episode_store', 'controlers/episode/store.php');
$router->get('/episode_update', 'controlers/episode/update.php');



$router->get('/podcast_create', 'controlers/podcast/create.php');
$router->get('/podcast_destroy', 'controlers/podcast/destroy.php');
$router->get('/podcast_edit', 'controlers/podcast/edit.php');
$router->get('/podcast_index', 'controlers/podcast/index.php');
$router->get('/podcast_list', 'controlers/podcast/list.php');
$router->get('/podcast_manage', 'controlers/podcast/manage.php');
$router->get('/podcast_show', 'controlers/podcast/show.php');
$router->get('/podcast_store', 'controlers/podcast/store.php');
$router->get('/podcast_update', 'controlers/podcast/update.php');


// -----------------------------------------------------------------------------



$router->get('/register_view', 'views/registertion/create_view.php');
$router->post('/register', 'views/registertion/store_view.php');

$router->get('/login', 'views/sessions/create.php');
$router->delete('/logout', 'views/sessions/destroy.php');
$router->post('/login', 'views/sessions/store.php');



$router->get('/', 'views/whisprly_view.php');

$router->get('/about', 'views/about_view.php');

$router->get('/contact', 'views/contact_view.php');



$router->get('/content_moderation_view', 'views/admin/content_moderation_view.php');
$router->get('/category_management_view', 'views/admin/category_management_view.php');



$router->get('/manage_my_content_view', 'controlers/creator/manage_my_content_view.php');
$router->get('/creator_dashboard_view', 'controlers/creator/creator_dashboard_view.php');




$router->get('/book_create_view', 'views/book/create_view.php');
$router->get('/book_destroy', 'views/book/destroy.php');
$router->get('/edit_view', 'views/book/edit_view.php');
$router->get('/book_index_view', 'views/book/index_view.php');
$router->get('/book_list_view', 'views/book/list_view.php');
$router->get('/book_manage_view', 'views/book/manage_view.php');
$router->get('/book_show_view', 'views/book/show_view.php');
$router->get('/book_store', 'views/book/store.php');
$router->get('/book_edit_view', 'views/book/edit_view.php');



$router->get('/episode_create_view', 'views/episode/create_view.php');
$router->get('/episode_destroy', 'views/episode/destroy.php');
$router->get('/episode_edit_view', 'views/episode/edit_view.php');
$router->get('/episode_index_view', 'views/episode/index_view.php');
$router->get('/episode_list_view', 'views/episode/list_view.php');
$router->get('/episode_manage_view', 'views/episode/manage_view.php');
$router->get('/episode_show_view', 'views/episode/show_view.php');
$router->get('/episode_store', 'views/episode/store.php');
$router->get('/episode_update', 'views/episode/update.php');



$router->get('/podcast_create_view', 'views/podcast/create_view.php');
$router->get('/podcast_destroy', 'views/podcast/destroy.php');
$router->get('/podcast_edit_view', 'views/podcast/edit_view.php');
$router->get('/podcast_index_view', 'views/podcast/index_view.php');
$router->get('/podcast_list_view', 'views/podcast/list_view.php');
$router->get('/podcast_manage_view', 'views/podcast/manage_view.php');
$router->get('/podcast_show_view', 'views/podcast/show_view.php');
$router->get('/podcast_store', 'views/podcast/store.php');
$router->get('/podcast_update', 'viewss/podcast/update.php');





