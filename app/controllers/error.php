<?php

namespace Evie\App\Controllers;

use Evie\System\Kernel\Controller;
use Evie\System\Template\Template;

class Error extends Controller {

	public function __construct()  {
		
    parent::__construct();
    
	}

	public function Index()  {

    $this->NotFound();
    
  }
	
	public function NotFound() {
		
    Template::view('error/error');

	}
    
}

?>
