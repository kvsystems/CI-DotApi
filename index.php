<?
namespace Evie;

//if( $_SERVER['REMOTE_ADDR'] != '10.3.200.144' ) die();

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );;

date_default_timezone_set( 'Asia/Yekaterinburg' );

session_start();

define( 'DS', DIRECTORY_SEPARATOR );
define( 'ROOT_DIR', realpath( dirname(__FILE__) ) . '/' );
define( 'APP_DIR', ROOT_DIR . 'app/' );

require( APP_DIR .'config/config.php' );
require( ROOT_DIR . 'system/init.php' );

global $config;
define('BASE_URL', $config['config']['base_url']);
define('APP_NAME', $config['config']['appname']);

System\Kernel::Init();
