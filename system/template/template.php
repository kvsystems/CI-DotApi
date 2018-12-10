<?php

namespace Evie\System\Template;

class Template  {

  const MOD_DIR = 'modules';
  const VIE_DIR = 'views';
  const FILE_EXT = '.php';
  const ERROR = 'error';

  public static function Render($template, $vars = [])   {
      $Path = '';

      if( is_file( APP_DIR . self::VIE_DIR . DS . "{$template}" . self::FILE_EXT ) ) {

          $Path = APP_DIR . self::VIE_DIR . DS . "{$template}" . self::FILE_EXT;

      } elseif( strpos( $template,'/' ) !== false ) {

          $View   = explode( '/',$template );
          $Module = $View[0];
          unset( $View[0] );
          $View  = implode( '/',$View );

          if( is_file( APP_DIR . self::MOD_DIR . DS . "{$Module}" .
              DS . self::VIE_DIR . DS . "{$View}" . self::FILE_EXT ) )  {

              $Path = APP_DIR ."modules/{$Module}/views/{$View}.php";

          }

      }

      if ( $Path != ''  && file_exists( $Path ) ) {

          extract( $vars );
          ob_start();

          require_once( $Path );

          $rendered = ob_get_clean();

      } else {

          $_SESSION['error_message'] = 'View File Missing';
          $rendered = false;

      }
      return $rendered;
  }

  public static function View( $template, $vars = [] ) {
        
    $Path = '';
    
    if( is_file( APP_DIR . self::VIE_DIR . DS . "{$template}" . self::FILE_EXT ) ) {
        
      $Path = APP_DIR . self::VIE_DIR . DS . "{$template}" . self::FILE_EXT;
        
    } elseif( strpos( $template,'/' ) !== false ) {
  
      $View   = explode( '/',$template );
      $Module = $View[0];
      unset( $View[0] );
      $View  = implode( '/',$View );
  
      if( is_file( APP_DIR . self::MOD_DIR . DS . "{$Module}" . 
          DS . self::VIE_DIR . DS . "{$View}" . self::FILE_EXT ) )  {
          
        $Path = APP_DIR ."modules/{$Module}/views/{$View}.php";
          
      }
          
    }

    if ( $Path != ''  && file_exists( $Path ) ) {
        
      extract( $vars );
      ob_start();
      
      require_once( $Path );
      
      echo ob_get_clean();
        
    } else {
        
      $_SESSION['error_message'] = 'View File Missing';
      redirect( self::ERROR );
        
    }

  }

}