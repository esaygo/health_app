<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = 'users';
$route['signin'] = 'users/signin';
$route['process_signin'] = 'users/process_signin/';
$route['register'] = 'users/register';
$route['process_register'] = 'users/process_register/';
$route['ajax'] = 'users/ajax';
$route['display_show_products'] = 'users/display_show_products';
$route['script'] = 'users/script';
$route['add_to_cart'] = 'users/add_to_cart';
$route['add_to_cart_process'] = 'users/add_to_cart_process';
$route['logout'] = 'users/logout';
$route['display_cart'] = 'users/display_cart';
$route['checkout/(:num)'] = 'users/checkout/$1';
$route['empty_cart/(:num)'] = 'users/empty_cart/$1';

$route[''] = 'users/index';
$route['404_override'] = 'errors/page_missing';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
