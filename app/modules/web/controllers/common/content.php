<?php

namespace Evie\App\Modules\Web\Controllers;

use Evie\System\Kernel\Controller;
use Evie\System\Kernel\Loader;
use Evie\System\Template\Template;

class Content extends Controller  {

    protected $access = null;

    public function __construct() {
        parent::__construct();
        $this->access = Loader::Model('access');
        Loader::Helper('trycatch');
    }

    public function Index() {

        $loggedUser     = $this->access->getLoggedUser($this->Cookie('session'));
        $availableRoute = $this->access->isAvailable($this->Server('REQUEST_URI'), $loggedUser);
        $isLogged       = $this->access->isLogged($this->Cookie('session'));

        if($availableRoute && $isLogged)   {
            return $this->_render(Loader::Controller('web/tools/router')->index());
        }

        if($availableRoute && !$isLogged)   {
            return $this->_render(Loader::Controller('web/tools/router')->index());
        }

        if(!$availableRoute && $isLogged)   {
            Redirect('dashboard');
        }

        if(!$availableRoute && !$isLogged)   {
            Redirect();
        }

    }

    private function _render($layout)  {
        if($layout) {
            foreach($layout as $module)  {
                $render[$module['moduleName']] = Loader::Controller($module['modulePath'])->index();
            }
        }
        return Template::Render('web/common/content', $render);
    }

}