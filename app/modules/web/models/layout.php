<?

namespace Evie\App\Modules\Web\Models;

use Evie\System\Kernel\Model;

class Layout extends Model  {

    const OPTION_ON  = 1;
    const OPTION_OFF = 0;

    public function __construct() {
        parent::__construct();
    }

    public function getLayout($route = false) {
        return $this->db['cabinet']->SelectCell(
            "SELECT layoutId FROM cab_routes WHERE routeUri = {?} AND routeState = {?} LIMIT 1",
            [$route, self::OPTION_ON]
        );
    }

    public function getLayoutTitle($layout = 0)    {
        return $this->db['cabinet']->SelectCell(
            "SELECT layoutName FROM cab_layout WHERE layoutId = {?} AND layoutState = {?} LIMIT 1",
            [$layout, self::OPTION_ON]
        );
    }

    public function getModules($layout = 0)    {
        $modules = $this->db['cabinet']->Selectcell(
            "SELECT modules FROM cab_layout WHERE layoutId = {?} AND layoutState = {?} LIMIT 1",
            [$layout, self::OPTION_ON]
        );
        return $modules ? json_decode($modules) : false;
    }

    public function getModulePath($moduleId = 0) {
        return $this->db['cabinet']->SelectString(
            "SELECT moduleName, modulePath FROM cab_modules WHERE moduleId = {?} AND moduleState = {?} LIMIT 1",
            [$moduleId, self::OPTION_ON]
        );
    }

    public function getNavigation($group = 0, $route = '/') {
        $response = false;
        $tree = $this->db['cabinet']->SelectTable(
            "SELECT * FROM cab_navigation n 
            LEFT JOIN cab_routes r ON n.routeId = r.routeId 
            WHERE r.routeUri IS NOT NULL 
            ORDER BY n.sortOrder ASC"
        );

        if($tree)   {
            for($i = 0; $i < count($tree); $i++)    {
                if(!in_array((int)$group, json_decode($tree[$i]['groupAvail'])))
                    continue;
                if(strripos($route, $tree[$i]['routeUri']) !== false)
                    $tree[$i]['active'] = true;
                if($tree[$i]['parent'] == 0)
                    $response[$tree[$i]['navigationId']] = $tree[$i];
                else {
                    if(!isset($response[$tree[$i]['parent']]['parentList'])){
                        $response[$tree[$i]['parent']]['parentList'] = [];
                    }
                    $response[$tree[$i]['parent']]['parentList'][$tree[$i]['navigationId']] = $tree[$i];
                }
            }
        }
        return $response;
    }

}