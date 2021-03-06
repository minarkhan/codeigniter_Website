<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.




$routes->group('auth', function($routes)
{
	$routes->get('login', 'Login::index');

	$routes->post('login', 'Auth::login');

	$routes->get('logout', 'Auth::logout');

});

$routes->group('admin', ['filter' => 'authFilter'], function($routes)
{
	$routes->get('dashboard', 'Dashboard::index');
	$routes->get('/', 'Dashboard::index');


    $routes->group('user', function($routes)
	{
		$routes->get('/', 'UserController::index');

		$routes->get('add', 'UserController::getAdd');
		$routes->post('add', 'UserController::postAdd');

		$routes->get('edit/(:num)', 'UserController::getEdit/$1');
		$routes->post('edit/(:num)', 'UserController::postEdit/$1');

		$routes->get('move/(:num)', 'UserController::remove/$1');

		$routes->get('delete/(:num)', 'UserController::delete/$1');
		$routes->post('delete/(:num)', 'UserController::delete/$1');

		$routes->get('restore/(:num)', 'UserController::restore/$1');
		$routes->post('restore/(:num)', 'UserController::restore/$1');
		
	});

    $routes->group('post', function($routes)
	{
		$routes->get('/', 'PostController::index');

		$routes->get('add', 'PostController::getAdd');
		$routes->post('add', 'PostController::postAdd');

		$routes->get('edit/(:num)', 'PostController::getEdit/$1');
		$routes->post('edit/(:num)', 'PostController::postEdit/$1');

		$routes->get('move/(:num)', 'PostController::remove/$1');

		$routes->get('delete/(:num)', 'PostController::delete/$1');
		$routes->post('delete/(:num)', 'PostController::delete/$1');

		$routes->get('restore/(:num)', 'PostController::restore/$1');
		$routes->post('restore/(:num)', 'PostController::restore/$1');
		
	});

	$routes->group('cate', function($routes)
	{
		$routes->get('/', 'CateController::index');

		$routes->get('add', 'CateController::getAdd');
		$routes->post('add', 'CateController::postAdd');

		$routes->get('edit/(:num)', 'CateController::getEdit/$1');
		$routes->post('edit/(:num)', 'CateController::postEdit/$1');

		$routes->get('delete/(:num)', 'CateController::delete/$1');
		$routes->post('delete/(:num)', 'CateController::delete/$1');
	});

	$routes->group('page', function($routes)
	{
		$routes->get('/', 'PageController::index');

		$routes->get('add', 'PageController::getAdd');
		$routes->post('add', 'PageController::postAdd');

		$routes->get('edit/(:num)', 'PageController::getEdit/$1');
		$routes->post('edit/(:num)', 'PageController::postEdit/$1');

		$routes->get('delete/(:num)', 'PageController::delete/$1');
		$routes->post('delete/(:num)', 'PageController::delete/$1');
	});


});


$routes->get('/', 'HomeController::index');


$routes->get('(:any)/(:any).html', 'HomeController::getDetailPost/$1/$2');

$routes->get('(:any).html', 'HomeController::getPage/$1');

$routes->get('search', 'HomeController::getSearch');

$routes->get('tags/(:any)', 'HomeController::tags/$1');

$routes->get('site-map.xml', 'HomeController::siteMap');

$routes->get('(:any)', 'HomeController::catePost/$1');








/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
