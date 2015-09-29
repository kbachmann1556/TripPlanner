<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'travels';
$route['register'] = 'travels/register';
$route['login'] = 'travels/login';
$route['travel_dash'] = 'travels/travel_dash';
$route['add_plan_page'] = 'travels/add_plan_page';
$route['add_trip'] = 'travels/add_trip';
$route['destination_page/(:any)'] = 'travels/destination_page/$1';
$route['join_trip/(:any)'] = 'travels/join_trip/$1';

$route['logout'] = 'travels/logout';



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
