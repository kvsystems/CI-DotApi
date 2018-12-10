<?

spl_autoload_register( "Autoloader" );

function Autoloader( $class ) {

  $File = strtolower( ROOT_DIR . str_replace('\\', '/', str_replace( 'Evie\\', '', $class ) ) . ".php" );
  if ( is_readable( $File ) ) require_once( $File );
    
}

function & GetInstance() {
    
  $Instance = new System\Core;
  return $Instance::GetInstance();
    
}
