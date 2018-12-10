<?php

namespace Evie\App\Modules\Web\Controllers;

use Evie\System\Kernel\Controller;
use Evie\System\Kernel\Loader;
use Evie\System\Template\Template;

class Navigation extends Controller  {

    protected $layout = null;
    protected $access = null;
    protected $router = null;

    public function __construct() {
        parent::__construct();
        $this->layout = Loader::Model('web/layout');
        $this->access = Loader::Model('access');
        $this->router = Loader::Controller('web/tools/router');
    }

    public function Index() {
        $render = [];
        $userData = $this->access->getLoggedUser($this->Cookie('session'));
        if($userData)   {
            $tree = $this->layout->getNavigation($userData['groupId'], $this->router->processRoute());
            if($tree) $render = $tree;
        }
        return $this->_render(['navigation' => $render]);
    }

    private function _render($data = [])  {
        return Template::Render('web/common/navigation', $data);
    }

}