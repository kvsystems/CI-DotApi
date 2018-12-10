<?php

namespace Evie\App\Modules\Web\Controllers;

use Evie\System\Kernel\Controller;
use Evie\System\Kernel\Loader;
use Evie\System\Template\Template;

class Authorization extends Controller  {

    public function __construct() {
        parent::__construct();
    }

    public function Index() {
        return Template::Render('web/forms/authorization', []);
    }

}