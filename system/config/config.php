<?
namespace Evie\System\Config;

class Config {

  const MOD_DIR = 'modules';
  const CONF_DIR = 'config';
  const FILE_EXT = '.php';

  private static $_config = array();
  private static $_key = false;
  
  public function __construct( $name ) {
  
    self::$_key = $name; 
    self::Init();
  
  }
  
  public static function Init() {

    $File = strpos( self::$_key, '/' ) !== false    
      ? self::_module()      
      : self::_default();
            
    return is_file( $File ) ? self::_connect( $File ) : false;       
  
  }
  
  public static function Get( $alias = false )  {

    return is_bool( $alias )
      ? static::$_config[ self::$_key ] 
      : self::_isset( $alias );          

  }

  public static function Set( $key = false, $value = false )  {
  
    if( !is_bool( $key ) && !is_bool( $value ) )  
      static::$_config[ $key ] = $value;
      
  }
  
  private static function _isset( $alias ) {
  
    return isset( static::$_config[ self::$_key ][ $alias ] )
      ? static::$_config[ self::$_key ][ $alias ] : null;
  
  }  
  
  private static function _module() {
  
    $Parts = explode( '/',self::$_key );
    
    return implode( array( 
      APP_DIR, self::MOD_DIR, DS, $Parts[0], DS, self::CONF_DIR, DS, $Parts[1], self::FILE_EXT
    ));  
  
  }
  
  private static function _default()  {

    return implode( 
      array( APP_DIR . self::CONF_DIR . DS . self::$_key . self::FILE_EXT ) 
    );     
  
  }
  
  private static function _connect( $file )  {
    
    global $config;
    
    require_once( $file );

    if ( !isset( $config ) || !is_array( $config ) )
      die( 'Your ' . $file . ' file does not appear to contain a valid configuration array.' );

    self::Set( self::$_key, $config[ self::$_key ] );

    return self::Get( self::$_key );    
  
  }  
  


}
