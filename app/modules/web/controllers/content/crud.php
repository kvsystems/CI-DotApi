<?php

namespace Evie\App\Modules\Web\Controllers;

use Evie\System\Kernel\Controller;
use Evie\System\Kernel\Loader;
use Evie\System\Template\Template;

class Crud extends Controller  {

    const PER_PAGE = 10;

    protected $layout = null;
    protected $record = null;

    public function __construct() {
        parent::__construct();
        $this->record = Loader::Model('task');
    }

    public function Index() {
        return Template::Render('web/content/crud', ['perPage' => self::PER_PAGE]);
    }

}