<?php

namespace Evie\App\Modules\Web\Controllers;

use Evie\System\Kernel\Controller;
use Evie\System\Kernel\Loader;
use Evie\System\Template\Template;

class Copyright extends Controller  {

    public function __construct() {
        parent::__construct();
    }

    public function Index() {
        return Template::Render('web/common/copyright', [
            'owner' => 'Kalugin Alexander &copy; KV-Systems, 2018.',
            'ver'   => 'Version 1.0 RELEASE.'
        ]);
    }

}