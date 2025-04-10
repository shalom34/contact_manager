<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
 $route['default_controller'] = 'main/LoginPage';
 $route['login'] = 'main/LoginPage/login';
 $route['register'] = 'main/LoginPage/register';
 $route['logout'] = 'main/LoginPage/log_out';
 $route['contacts'] = 'main/ContactPage';
  $route['contacts/add'] = 'main/ContactPage/insert_contact';
  $route['contacts/edit'] = 'main/ContactPage/insert_or_update_contact';
  $route['contacts/get'] = 'main/ContactPage/get_contacts';
  $route['contacts/get_infos/(:any)'] = 'main/ContactPage/get_contact_infos/$1';
  $route['contacts/delete/(:any)'] = 'main/ContactPage/delete_contact/$1';
  $route['contacts/toggle_favorite/(:any)'] = 'main/ContactPage/toggle_favorite/$1';



