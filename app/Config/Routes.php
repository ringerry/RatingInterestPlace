<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

$routes->get('BasicController', 'BasicController::index');

$routes->group("api", function ($routes) {
    $routes->post("register", "Register::index");
    $routes->post("login", "Login::index");
});


$routes->setDefaultNamespace("App\Controllers\City");
$routes->group("api", function ($routes) {
    $routes->post("city", "Create::index", ['filter' => 'authFilter']);
    $routes->get("city", "Read::index", ['filter' => 'authFilter']);
    $routes->put("city", "Update::index", ['filter' => 'authFilter']);
    $routes->delete("city", "Delete::index", ['filter' => 'authFilter']);

    $routes->get("city/users", "UsersByCity::index", ['filter' => 'authFilter']);
    $routes->get("city/places", "PlacesByCity::index", ['filter' => 'authFilter']);
});

$routes->setDefaultNamespace("App\Controllers\Place");
$routes->group("api", function ($routes) {
    $routes->post("place", "Create::index", ['filter' => 'authFilter']);
    $routes->get("place", "Read::index", ['filter' => 'authFilter']);
    $routes->put("place", "Update::index", ['filter' => 'authFilter']);
    $routes->delete("place", "Delete::index", ['filter' => 'authFilter']);
});

$routes->setDefaultNamespace("App\Controllers\User");
$routes->group("api", function ($routes) {
    $routes->post("rating", "Rating::index", ['filter' => 'authFilter']);
    $routes->get("users", "User::index", ['filter' => 'adminFilter']);

    $routes->get("user/cities", "CitiesByUser::index", ['filter' => 'authFilter']);


//    $routes->get("place", "Read::index", ['filter' => 'authFilter']);
//    $routes->put("place", "Update::index", ['filter' => 'authFilter']);
//    $routes->delete("place", "Delete::index", ['filter' => 'authFilter']);
});
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
