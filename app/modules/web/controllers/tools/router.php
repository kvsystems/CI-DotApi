<?php

namespace Evie\App\Modules\Web\Controllers;

use Evie\System\Kernel\Controller;
use Evie\System\Kernel\Loader;
use Evie\System\Template\Template;

class Router extends Controller  {

    protected $layout = null;

    public function __construct() {
        parent::__construct();
        $this->layout = Loader::Model('web/layout');
    }

    public function processRoute()  {
        return $this->Server('REQUEST_URI');
    }

    public function Index() {
        $data = [];

        $layoutId = $this->layout->getLayout($this->processRoute());
        $moduleList  = $this->layout->getModules($layoutId);

        if($moduleList) {
            foreach($moduleList as $moduleId)   {
                $temp = $this->layout->getModulePath($moduleId);
                if($temp) $data[] = $temp;
            }
        }
        return $data;
    }

}