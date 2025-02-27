<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	// Offline development
	// 'username' => 'root',
	// 'password' => '',

	// Online Production
	// 'username' => 'wisy2434_wisdil',
	// 'password' => 'wisdil2023',
	// 'database' => 'wisy2434_wisdil',


	'username' => 'wisy2434_mitra',
	'password' => 'mitra123',
	'database' => 'wisy2434_mitra',

	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);