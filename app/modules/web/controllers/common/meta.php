<?php

namespace Evie\App\Modules\Web\Controllers;

use Evie\System\Kernel\Controller;
use Evie\System\Kernel\Loader;
use Evie\System\Template\Template;

class Meta extends Controller  {

    protected $layout = null;

    public function __construct() {
        parent::__construct();
        $this->layout = Loader::Model('web/layout');
    }

    public function Index() {
        return Template::Render('web/common/meta', [
            'title' => APP_NAME . ' :: ' . $this->layout->getLayoutTitle(
                $this->layout->getLayout($this->Server('REQUEST_URI'))
            )
        ]);
    }

    public function Authorization() {
        return Template::Render('web/common/meta', [
            'title' => APP_NAME . ' :: ' . $this->layout->getLayoutTitle(
                    $this->layout->getLayout('/')
                )
        ]);
    }

}