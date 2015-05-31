<?php
/**
 * Created by PhpStorm.
 * User: Pavel Zlatarov
 * Date: 30.5.2015 г.
 * Time: 8:07
 */

$config['fuelo_apikey'] = '';
$config['maps_browserkey'] = '';
$config['url_gasoline'] = 'http://fuelo.net/api/price?key='.$config['fuelo_apikey'].'&fuel=gasoline';
$config['url_diesel'] = 'http://fuelo.net/api/price?key='.$config['fuelo_apikey'].'&fuel=diesel';
$config['url_lpg'] = 'http://fuelo.net/api/price?key='.$config['fuelo_apikey'].'&fuel=lpg';
$config['url_methane'] = 'http://fuelo.net/api/price?key='.$config['fuelo_apikey'].'&fuel=methane';
$config['url_near'] = 'http://fuelo.net/api/near?key='.$config['fuelo_apikey'];
$config['cache_time'] = 86400;
$config['custom_date_format'] = 'd.m.Y G:i';