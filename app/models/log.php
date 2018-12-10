<?

namespace Evie\App\Models;

use Evie\System\Kernel\Model;

class Log extends Model  {

  public function __construct() {
    parent::__construct();
  }

  public function getMessage($code)  {
      return $this->db['cabinet']->SelectString(
          "SELECT m.messageText, l.levelName FROM cab_messages m 
          LEFT JOIN cab_messages_level l ON m.messageLevel = l.levelId 
          WHERE m.messageId = {?} LIMIT 1", [(int)$code]
      );
  }

}