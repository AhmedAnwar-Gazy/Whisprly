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


$router->get('/register', 'controlers/registertion/create.php');
$router->post('/register', 'controlers/registertion/store.php');

$router->get('/login', 'controlers/sessions/create.php');
$router->delete('/logout', 'controlers/sessions/destroy.php');
$router->post('/login', 'controlers/sessions/store.php');



$router->get('/', 'controlers/whisprly.php');

$router->get('/about', 'controlers/about.php');

$router->get('/contact', 'controlers/contact.php');


$router->get('/data', 'controlers/data.php');



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



$router->get('/register_view', 'views/pages/registertion/create_view.php');
$router->post('/register', 'views/pages/registertion/store_view.php');

$router->get('/login', 'views/pages/sessions/create.php');
$router->delete('/logout', 'views/pages/sessions/destroy.php');
$router->post('/login', 'views/pages/sessions/store.php');



$router->get('/', 'views/pages/whisprly_view.php');

$router->get('/about', 'views/pages/about_view.php');

$router->get('/contact', 'views/pages/contact_view.php');



$router->get('/content_moderation_view', 'views/pages/admin/content_moderation_view.php');
$router->get('/category_management_view', 'views/pages/admin/category_management_view.php');
$router->get('/dashboard_admin_view', 'views/pages/admin/dashboard_admin_view.php');
$router->get('/reports_view', 'views/pages/admin/reports_view.php');
$router->get('/user_managment_view', 'views/pages/admin/user_managment_view.php');



$router->get('/manage_my_content_view', 'views/pages/creator/manage_my_content_view.php');
$router->get('/creator_dashboard_view', 'views/pages/creator/creator_dashboard_view.php');




$router->get('/book_create_view', 'views/pages/book/create_view.php');
$router->get('/book_destroy', 'views/pages/book/destroy.php');
$router->get('/edit_view', 'views/pages/book/edit_view.php');
$router->get('/book_index_view', 'views/pages/book/index_view.php');
$router->get('/book_list_view', 'views/pages/book/list_view.php');
$router->get('/book_manage_view', 'views/pages/book/manage_view.php');
$router->get('/book_show_view', 'views/pages/book/show_view.php');
$router->get('/book_store', 'views/pages/book/store.php');
$router->get('/book_edit_view', 'views/pages/book/edit_view.php');



$router->get('/episode_create_view', 'views/pages/episode/create_view.php');
$router->get('/episode_destroy', 'views/pages/episode/destroy.php');
$router->get('/episode_edit_view', 'views/pages/episode/edit_view.php');
$router->get('/episode_index_view', 'views/pages/episode/index_view.php');
$router->get('/episode_list_view', 'views/pages/episode/list_view.php');
$router->get('/episode_manage_view', 'views/pages/episode/manage_view.php');
$router->get('/episode_show_view', 'views/pages/episode/show_view.php');
$router->get('/episode_store', 'views/pages/episode/store.php');
$router->get('/episode_update', 'views/pages/episode/update.php');



$router->get('/podcast_create_view', 'views/pages/podcast/create_view.php');
$router->get('/podcast_destroy', 'views/pages/podcast/destroy.php');
$router->get('/podcast_edit_view', 'views/pages/podcast/edit_view.php');
$router->get('/podcast_index_view', 'views/pages/podcast/index_view.php');
$router->get('/podcast_list_view', 'views/pages/podcast/list_view.php');
$router->get('/podcast_manage_view', 'views/pages/podcast/manage_view.php');
$router->get('/podcast_show_view', 'views/pages/podcast/show_view.php');
$router->get('/podcast_store', 'views/pages/podcast/store.php');
$router->get('/podcast_update', 'viewss/pages/podcast/update.php');
