<?php

namespace Evie\App\Controllers;

use Evie\System\Kernel\Loader;
use Evie\System\Template\Template;
use Evie\App\Core\AppController;

class Main extends AppController  {

    protected $access = null;

	public function __construct() {
        parent::__construct();
        $this->access = Loader::Model('access');
	}

	public function Index()  {

	    Template::View( "web/common/home",
            [
                'meta'          => Loader::Controller('web/common/meta')->index(),
                'header'        => Loader::Controller('web/common/header')->index(),
                'navigation'    => Loader::Controller('web/common/navigation')->index(),
                'content'       => Loader::Controller('web/common/content')->index(),
                'copyright'     => Loader::Controller('web/common/copyright')->index(),
                'scripts'       => Loader::Controller('web/common/scripts')->index()
            ]
        );

	}

}