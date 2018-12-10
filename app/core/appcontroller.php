<?

namespace Evie\App\Core;

use Evie\System\Kernel\Controller;
use Evie\System\Kernel\Loader;

class AppController extends Controller  {

    protected $access = null;

    public static $dirs = [
      'assets'    => APP_DIR . 'views' . DS . 'assets' . DS,
      'styles'    => APP_DIR . 'views' . DS . 'assets' . DS . 'styles' . DS,
      'scripts'   => APP_DIR . 'views' . DS . 'assets' . DS . 'scripts' . DS,
      'libraries' => APP_DIR . 'views' . DS . 'assets' . DS . 'libraries' . DS,
      'image'     => APP_DIR . 'views' . DS . 'assets' . DS . 'image' . DS,
      'fonts'     => APP_DIR . 'views' . DS . 'assets' . DS . 'fonts' . DS
    ];

    public function __construct() {
        parent::__construct();
    }
    
    public static function GetDirs() {
      
      return self::$dirs;
      
    }

}