<?php

namespace Evie\System\Database;

use Evie\System\Kernel;

abstract class Database {

  public function SelectTable( $query, $params = false ){}
  public function SelectString( $query, $params = false ){}
  public function SelectCell( $query, $params = false ){}
  public function Modify( $query, $params = false ){}

}