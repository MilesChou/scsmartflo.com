<?php
/**
 * This is needed for cookie based authentication to encrypt password in
 * cookie
 */
$cfg['blowfish_secret'] = 'secret';

/**
 * Servers configuration
 */
$i = 0;

/**
 * First server
 */
$i++;

$host = getenv('MYSQL_HOST') ? getenv('MYSQL_HOST') : 'mysql';
$user = getenv('MYSQL_USERNAME') ? getenv('MYSQL_USERNAME') : 'root';
$pass = getenv('MYSQL_PASSWORD') ? getenv('MYSQL_PASSWORD') : 'password';

$cfg['Servers'][$i]['auth_type'] = 'config';
$cfg['Servers'][$i]['user'] = $user;
$cfg['Servers'][$i]['password'] = $pass;
$cfg['Servers'][$i]['host'] = $host;
$cfg['Servers'][$i]['connect_type'] = 'tcp';
$cfg['Servers'][$i]['compress'] = false;
$cfg['Servers'][$i]['AllowNoPassword'] = false;
