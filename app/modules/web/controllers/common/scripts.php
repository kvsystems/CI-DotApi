<?php

namespace Evie\App\Modules\Web\Controllers;

use Evie\System\Kernel\Controller;
use Evie\System\Kernel\Loader;
use Evie\System\Template\Template;

class Scripts extends Controller  {

    public function __construct() {
        parent::__construct();
    }

    public function Index() {
        $data = [];
        return Template::Render('web/common/scripts', $data);
    }

}