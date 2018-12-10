<?

namespace Evie\System\Kernel;

use Evie\System\Kernel;

class Controller extends Kernel {

	public function __construct()  {
		
    parent::__construct();

	}

  public function Get( $input ) {

    return !empty( $_GET[$input] )
      ? strip_tags( $_GET[$input] ) : false; 
    
  }

  public function Server($input)  {
      return !empty( $_SERVER[$input] )
          ? strip_tags( $_SERVER[$input] ) : false;
  }

	public function Post( $input ) {
		
    return isset( $_POST[$input] )
      ? strip_tags($_POST[$input]) : false;
    	
  }

    public function Cookie( $input ) {

        return isset( $_COOKIE[$input] )
            ? strip_tags($_COOKIE[$input]) : false;

    }

}