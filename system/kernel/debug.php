<?php
namespace Evie\System\Kernel;

class Debug extends \Exception {

  const ERROR = 'error';
  const CTL_DIR = 'controllers';
  const FILE_EXT = '.php'; 

  public static function Message( $text ) {

    $_SESSION['message'] = $text;
    
    require_once(implode( array(
      APP_DIR, self::CTL_DIR, DS, self::ERROR, self::FILE_EXT
    )));
    
  }

}