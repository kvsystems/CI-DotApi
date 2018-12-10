<?

namespace Evie\App\Models;

use Evie\System\Kernel\Model;

class Access extends Model  {

    const OPTION_ON  = 1;
    const OPTION_OFF = 0;

    public function __construct() {
        parent::__construct();
    }

    public function isLogged($session = false)  {
        return $this->db['cabinet']->SelectCell(
            "SELECT sessionHash FROM cab_sessions WHERE sessionHash = {?} AND sessionStatus = {?} LIMIT 1",
            [$session, self::OPTION_ON]
        );
    }

    public function getLoggedUser($session) {
        return $this->db['cabinet']->SelectString(
            "SELECT u.login,g.groupName,g.groupId FROM cab_sessions s 
            LEFT JOIN cab_users u ON s.userId = u.userId 
            LEFT JOIN cab_groups g ON u.groupId = g.groupId 
            WHERE s.sessionHash = {?} LIMIT 1",
            [$session]
        );
    }

    public function isAvailable($route = false, $user = false)   {
        $response = false;

        $user = !$user ? $user = 0 : $user['groupId'];
        $isAvail = $this->db['cabinet']->SelectCell(
            "SELECT groupsAvailable FROM cab_routes WHERE routeUri = {?} AND routeState = {?} LIMIT 1",
            [$route, self::OPTION_ON]
        );

        if($isAvail && in_array($user, json_decode($isAvail)))    {
            $response = true;
        }

        return $response;
    }

    public function issetUser($login = false, $password = false) {
        return $this->db['cabinet']->SelectCell(
            "SELECT userId FROM cab_users WHERE login = {?} AND password = {?} LIMIT 1",
            [$login, md5(md5($password))]
        );
    }

    public function createUser($registration = [])    {
        $salt = false;
        $userId = $this->db['cabinet']->Modify(
            "INSERT INTO cab_users VALUES(NULL,{?},NULL,{?},NULL,{?},{?},{?})",
            [
                $registration['group'],
                md5(md5($registration['password'])),
                date("Y-m-d H:i:s"),
                $registration['ipa'],
                $registration['status']
            ]
        );

        if( $userId )   {
            $this->db['cabinet']->Modify(
                "UPDATE cab_users SET login = {?} WHERE userId = {?} LIMIT 1",
                ['user' . $userId, $userId]
            );
            $salt = substr(md5($userId), 0, 4);
        }

        return $userId
            ? ['login' =>'user' . $userId, 'password' => $registration['password'], 'salt' => $salt, 'id' => $userId ]
            : false;

    }

    public function createSession($userId, $hash) {
        return $this->db['cabinet']->Modify(
            "INSERT INTO cab_sessions VALUES(NULL,{?},{?},{?},{?},{?},{?})",
            [
                $hash,
                $userId,
                2,
                date("Y-m-d H:i:s"),
                date("Y-m-d H:i:s",strtotime('+1 day')),
                1
            ]
        );
    }

    public function dropSession($session)   {
        return $this->db['cabinet']->Modify(
            "DELETE FROM cab_sessions WHERE sessionHash = {?}",
            [$session]
        );
    }

}