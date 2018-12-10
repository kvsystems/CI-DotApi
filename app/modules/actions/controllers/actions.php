<?php

namespace Evie\App\Modules\Actions\Controllers;

use Evie\System\Kernel\Controller;
use Evie\System\Kernel\Loader;

class Actions extends Controller  {

  const LANGUAGE = 'ru_RU';
  const PER_PAGE = 10;

  protected $rest   = null;
  protected $log    = null;
  protected $access = null;
  protected $curl   = null;
  protected $crypt  = null;
  protected $record = null;

  public function __construct() {
      
    parent::__construct();
    $this->log      = Loader::Model('log');
    $this->access   = Loader::Model('access');
    $this->curl     = Loader::Model('curl');
    $this->record   = Loader::Model('task');
    $this->rest     = Loader::Library('rest');
    $this->crypt    = Loader::Library('crypt');
    Loader::Helper('types');

  }

  public function activation()  {
    $activationKey = $this->Post('activationKey') ? $this->Post('activationKey') : false;

    if(!$activationKey)   {
        $message = $this->log->getMessage(2);
        return $this->rest->Response(
            [
                'status'  => 'error',
                'code'    => 2,
                'level'   => $message['levelName'],
                'message' => $message['messageText']
            ],
            $this->rest->GetStatus( 'HTTP_NOT_FOUND' )
        );
    }

    $message = $this->log->getMessage(1);
    return $this->rest->Response(
        [
            'status'  => 'success',
            'code'    => 1,
            'level'   => $message['levelName'],
            'message' => $message['messageText']
        ],
        $this->rest->GetStatus( 'HTTP_OK' )
    );
  }

    public function authorization()  {

        $login      = $this->Post('userName') ? $this->Post('userName') : false;
        $password   = $this->Post('userPassword') ? $this->Post('userPassword') : false;

        $issetUser = $this->access->issetUser($login, $password);

        if(!$issetUser)   {
            $message = $this->log->getMessage(4);
            return $this->rest->Response(
                [
                    'status'  => 'error',
                    'code'    => 4,
                    'level'   => $message['levelName'],
                    'message' => $message['messageText']
                ],
                $this->rest->GetStatus( 'HTTP_NOT_FOUND' )
            );
        }

        $hash = $this->crypt->generateMd5();
        $session = $this->access->createSession($issetUser, $hash);
        if(!$session)   {
            $message = $this->log->getMessage(9);
            return $this->rest->Response(
                [
                    'status'  => 'error',
                    'code'    => 9,
                    'level'   => $message['levelName'],
                    'message' => $message['messageText']
                ],
                $this->rest->GetStatus( 'HTTP_NOT_ACCEPTABLE' )
            );
        }

        $message = $this->log->getMessage(3);
        return $this->rest->Response(
            [
                'status'  => 'success',
                'code'    => 3,
                'level'   => $message['levelName'],
                'message' => $message['messageText'],
                'session' => $hash
            ],
            $this->rest->GetStatus( 'HTTP_OK' )
        );
    }

    public function registration()  {

        $keyId     = $this->Post('keyId') ? $this->Post('keyId') : false;
        $keyValue  = $this->Post('keyValue') ? $this->Post('keyValue') : false;

        if(!$keyId || !$keyValue)   {
            $message = $this->log->getMessage(6);
            return $this->rest->Response(
                [
                    'status'  => 'error',
                    'code'    => 6,
                    'level'   => $message['levelName'],
                    'message' => $message['messageText']
                ],
                $this->rest->GetStatus( 'HTTP_NOT_FOUND' )
            );
        }

        $newUser = $this->access->createUser([
            'group'     => 2,
            'password'  => $keyValue,
            'ipa'       => $this->Server('REMOTE_ADDR'),
            'status'    => 1
        ]);

        if(!$newUser)   {
            $message = $this->log->getMessage(7);
            return $this->rest->Response(
                [
                    'status'  => 'error',
                    'code'    => 7,
                    'level'   => $message['levelName'],
                    'message' => $message['messageText']
                ],
                $this->rest->GetStatus( 'HTTP_NOT_ACCEPTABLE' )
            );
        }

        $licenseData = [
            'licenseKey'        => md5( $newUser['password'] ),
            'licenseSalt'       => $newUser['salt'],
            'licenseHash'       => md5( $newUser['password'].$newUser['salt'] ),
            'activationKey'     => (int)$keyId,
            'licenseStatus'  => 1
        ];

        $uri = 'http://iptv.kv-sys.ru/records/licenses';
        $response = $this->curl->sendPostQuery( $uri, $licenseData );

        if(empty($response))    {
            $message = $this->log->getMessage(8);
            return $this->rest->Response(
                [
                    'status'  => 'error',
                    'code'    => 8,
                    'level'   => $message['levelName'],
                    'message' => $message['messageText']
                ],
                $this->rest->GetStatus( 'HTTP_NOT_ACCEPTABLE' )
            );
        }

        $hash = $this->crypt->generateMd5();
        $session = $this->access->createSession($newUser['id'], $hash);

        if(!$session)   {
            $message = $this->log->getMessage(9);
            return $this->rest->Response(
                [
                    'status'  => 'error',
                    'code'    => 9,
                    'level'   => $message['levelName'],
                    'message' => $message['messageText']
                ],
                $this->rest->GetStatus( 'HTTP_INTERNAL_SERVER_ERROR' )
            );
        }

        $message = $this->log->getMessage(5);
        return $this->rest->Response(
            [
                'status'  => 'success',
                'code'    => 5,
                'level'   => $message['levelName'],
                'message' => $message['messageText'],
                'session' => $hash
            ],
            $this->rest->GetStatus( 'HTTP_OK' )
        );
    }

    public function logout()   {
      $session = $this->Post('session') ? $this->Post('session') : false;

      if(!$session)   {
            $message = $this->log->getMessage(10);
            return $this->rest->Response(
                [
                    'status'  => 'error',
                    'code'    => 10,
                    'level'   => $message['levelName'],
                    'message' => $message['messageText']
                ],
                $this->rest->GetStatus( 'HTTP_NOT_FOUND' )
            );
        }

        $drop = $this->access->dropSession($session);

        if(!$drop)   {
            $message = $this->log->getMessage(12);
            return $this->rest->Response(
                [
                    'status'  => 'error',
                    'code'    => 12,
                    'level'   => $message['levelName'],
                    'message' => $message['messageText']
                ],
                $this->rest->GetStatus( 'HTTP_NOT_ACCEPTABLE' )
            );
        }

        $message = $this->log->getMessage(11);
        return $this->rest->Response(
            [
                'status'  => 'success',
                'code'    => 11,
                'level'   => $message['levelName'],
                'message' => $message['messageText']
            ],
            $this->rest->GetStatus( 'HTTP_OK' )
        );

    }

    public function tasks() {
        $data = $this->record->getTasks(self::LANGUAGE);

        if(!$data)   {
            $message = $this->log->getMessage(13);
            return $this->rest->Response(
                [
                    'status'  => 'error',
                    'code'    => 13,
                    'level'   => $message['levelName'],
                    'message' => $message['messageText']
                ],
                $this->rest->GetStatus( 'HTTP_NOT_ACCEPTABLE' )
            );
        }

        $message = $this->log->getMessage(14);
        return $this->rest->Response(
            [
                'status'  => 'success',
                'code'    => 14,
                'tasks'   => $data,
                'level'   => $message['levelName'],
                'message' => $message['messageText']
            ],
            $this->rest->GetStatus( 'HTTP_OK' )
        );
    }

    public function task()  {

      $data = $this->record->getTaskById(self::LANGUAGE);

        if(!$data)   {
            $message = $this->log->getMessage(13);
            return $this->rest->Response(
                [
                    'status'  => 'error',
                    'code'    => 13,
                    'level'   => $message['levelName'],
                    'message' => $message['messageText']
                ],
                $this->rest->GetStatus( 'HTTP_NOT_ACCEPTABLE' )
            );
        }

        $message = $this->log->getMessage(14);
        return $this->rest->Response(
            [
                'status'  => 'success',
                'code'    => 14,
                'task'    => $data,
                'level'   => $message['levelName'],
                'message' => $message['messageText']
            ],
            $this->rest->GetStatus( 'HTTP_OK' )
        );
    }

    public function taskCount() {
        $data = $this->record->countTasks(self::LANGUAGE);

        if(!$data)   {
            $message = $this->log->getMessage(13);
            return $this->rest->Response(
                [
                    'status'  => 'error',
                    'code'    => 13,
                    'level'   => $message['levelName'],
                    'message' => $message['messageText']
                ],
                $this->rest->GetStatus( 'HTTP_NOT_ACCEPTABLE' )
            );
        }

        $message = $this->log->getMessage(14);
        return $this->rest->Response(
            [
                'status'  => 'success',
                'code'    => 14,
                'count'   => (int) $data,
                'level'   => $message['levelName'],
                'message' => $message['messageText']
            ],
            $this->rest->GetStatus( 'HTTP_OK' )
        );
    }

    public function taskPage()  {
        $data = $this->record->getTasksPage(self::PER_PAGE, self::LANGUAGE);

        if(!$data)   {
            $message = $this->log->getMessage(13);
            return $this->rest->Response(
                [
                    'status'  => 'error',
                    'code'    => 13,
                    'level'   => $message['levelName'],
                    'message' => $message['messageText']
                ],
                $this->rest->GetStatus( 'HTTP_NOT_ACCEPTABLE' )
            );
        }

        $message = $this->log->getMessage(14);
        return $this->rest->Response(
            [
                'status'  => 'success',
                'code'    => 14,
                'tasks'   => $data,
                'level'   => $message['levelName'],
                'message' => $message['messageText']
            ],
            $this->rest->GetStatus( 'HTTP_OK' )
        );
    }

    public function search()    {
        $data = $this->record->getTasksByName(self::LANGUAGE);

        if(!$data)   {
            $message = $this->log->getMessage(13);
            return $this->rest->Response(
                [
                    'status'  => 'error',
                    'code'    => 13,
                    'level'   => $message['levelName'],
                    'message' => $message['messageText']
                ],
                $this->rest->GetStatus( 'HTTP_NOT_ACCEPTABLE' )
            );
        }

        $message = $this->log->getMessage(14);
        return $this->rest->Response(
            [
                'status'  => 'success',
                'code'    => 14,
                'tasks'   => $data,
                'level'   => $message['levelName'],
                'message' => $message['messageText']
            ],
            $this->rest->GetStatus( 'HTTP_OK' )
        );
    }
  
}