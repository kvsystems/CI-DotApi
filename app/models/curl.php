<?

namespace Evie\App\Models;

use Evie\System\Kernel\Model;

class Curl extends Model  {

    public function __construct() {
        parent::__construct();
    }

    public function sendPostQuery($uri = false, $data = []) {
        $out = '';
        if( $curl = curl_init() ) {
            curl_setopt($curl, CURLOPT_URL, $uri);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $out = curl_exec($curl);
            curl_close($curl);
        }
        return $out;
    }

}