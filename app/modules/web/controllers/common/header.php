<?php

namespace Evie\App\Modules\Web\Controllers;

use Evie\System\Kernel\Controller;
use Evie\System\Kernel\Loader;
use Evie\System\Template\Template;

class Header extends Controller  {

    protected $access = null;

    public function __construct() {
        parent::__construct();
        $this->access = Loader::Model('access');
    }

    public function Index() {
        $userData = $this->access->getLoggedUser($this->Cookie('session'));
        if($userData)   {
            $render = [
                'admin' => [
                    'group'   => $userData['groupName'],
                    'name'    => $userData['login'],
                    'ipa'     => $this->Server('REMOTE_ADDR')
                ],
                'isLogged' => true
            ];
        } else {
            $render = [
                'admin' => [
                    'group'   => '',
                    'name'    => '',
                    'surname' => '',
                    'ipa'     => $this->Server('REMOTE_ADDR')
                ],
                'isLogged' => false
            ];
        }

        return $this->_render($render);
    }

    private function _render($data = [])  {
        return Template::Render('web/common/header', $data);
    }

}