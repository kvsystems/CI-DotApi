<?
namespace Evie\System;

use Evie\System\Config\Config;
use Evie\System\Kernel\Debug;
use Evie\System\Router\Router;

class Kernel {
  
  const STACK_CONF = 'config';
  const STACK_ROUTE = 'route';
  
  const MOD_DIR = 'modules';
  const CTL_DIR = 'controllers';
  const FILE_EXT = '.php';   
  
  public $Route = null;
  private static $_instance = null;
  
  public function __construct() {
    
    self::$_instance = $this;
    
  }
  
  public static function Init() {
  
    $Method = strtolower( $_SERVER['REQUEST_METHOD'] );
  
    $Config = new Config( self::STACK_CONF );
    
    $Controller = $Config::Get( 'default_controller' );
    $Error      = $Config::Get( 'error_controller' );
    $Action     = $Config::Get( 'default_method' );
    $Url        = '';
    
    $Routes = new Config( self::STACK_ROUTE );
    $Routes = $Routes::Get();
    
    $Route = new Router();

    $Route->Get( "/", "{$Controller}@{$Action}" );

    if( isset( $Routes[ $Method ] ) ) {

      foreach ( $Routes[ $Method ] as $Mask => $Value ) 
        $Route->Add( $Mask, $Value, $_SERVER['REQUEST_METHOD'] );
    
    }

      
    $Match = $Route->Match( self::GetUri(), $_SERVER['REQUEST_METHOD'] );
    
    if( is_array( $Match ) && isset( $Match['module'] ) ) {

      $Module      = $Match['module'];
      $Controller = $Match['controller'];
      $FController = ucfirst( $Controller );
      $Action      = $Match['action'];
      $Params      = $Match['params'];

      $Namespace  = "Evie\\App\\Modules\\{$Module}\\Controllers\\{$FController}";  
      $File       = implode( array( 
        APP_DIR, self::MOD_DIR, DS, "{$Module}", DS, 
        self::CTL_DIR, DS, "{$Controller}", self::FILE_EXT
      ));      
    
    } elseif( is_array( $Match ) ) {

      $Controller  = $Match['controller'];
      $FController = ucfirst( $Controller );
      $Action      = $Match['action'];
      $Params      = $Match['params'];

      $Namespace  = "Evie\\App\\Controllers\\{$FController}";
      $File       = implode( array(
        APP_DIR, self::CTL_DIR, DS, "{$Controller}", self::FILE_EXT
      ));      
    
    } elseif( is_bool( $Match ) ) {
    
      $Segments = explode( '/', self::GetUri() );
      $Params   = array_slice( $Segments, 2 );

      if( isset( $Segments[0] ) && $Segments[0] != '' )
        $Controller = $Segments[0];
        
      if( isset( $Segments[1] ) && $Segments[1] != '' ) 
        $Action = $Segments[1];
  
      $FController = ucfirst( $Controller );
      
      $Namespace   = "Evie\\App\\Controllers\\{$FController}";
      $File        = implode( array ( 
        APP_DIR, self::CTL_DIR, DS, "{$Controller}", self::FILE_EXT
      ));

    }

    if( is_file( $File ) ) {
      
      require_once( $File );
      
    } else {

      $Namespace = "Evie\\App\\Controllers\\{$Error}";
      $Action = 'index';      
      //Debug::Message( "Controller {$FController} not found" );
      Debug::Message( 'Unable to start the application' );
        
    }

    if( !method_exists( $Namespace, $Action ) ) {

      Debug::Message( "Action {$Action} not found" );
      $Action = 'index';

    }

    $Instance = new $Namespace();
    self::$_instance->Route = $Match;

    die( call_user_func_array( array( $Instance, $Action ), $Params ) );
              
  }
  
  public static function &GetInstance() {
    
    return self::$_instance;
    
  }  
  
  public static function GetUri()  {

    $Path = explode( '/', trim( $_SERVER['SCRIPT_NAME'], '/' ) );
    $Uri  = explode( '/', trim( $_SERVER['REQUEST_URI'], '/' ) );

    foreach( $Path as $Key => $Value ) {
      
      if( isset( $Uri[$Key] ) && $Value == $Uri[$Key] ) 
        unset( $Uri[$Key] ); 
      else break;
            
    }

    return implode( '/', $Uri );
    
  }     

}
