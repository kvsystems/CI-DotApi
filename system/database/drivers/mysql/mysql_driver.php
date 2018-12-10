<?php

namespace Evie\System\Database\Drivers\Mysql;

use Evie\System\Database\Database;
use Evie\System\Database\Interfaces;

class Mysql_driver extends Database {

  private $_placeholder = '{?}';
  protected $config     = null;
  protected $connection = null;
  public $charset       = 'utf8';

  public function __construct( $config )  {
    $this->connection = mysqli_connect( 
      $config['hostname'], 
      $config['username'], 
      $config['password']
    ) or die('Couldnt Connect Mysql');
    
    if( $this->connection ) {
      
      mysqli_select_db( 
        $this->connection, $config['database']
      ) or die( "<b>{$config['database']}</b> could not be found" );
      
      $this->connection->query("SET lc_time_names = 'ru_RU'");
      $this->connection->query("SET NAMES '" . $this->charset . "'");
          
    }

  }


  public function Query( $query, $params ) {
		
    if($params)	{
			for($i = 0; $i < count($params); $i++)	{
				$pos = strpos( $query, $this->_placeholder );
				$arg = "'" . $this->connection->real_escape_string( $params[$i]) . "'";
				$query = substr_replace($query, $arg, $pos, strlen($this->_placeholder));
			}
		}

		return $query;
    
  }
  
	public function SelectTable($query, $params = false)	{
		$result_set = $this->connection->query($this->Query($query, $params));
		if(!$result_set || @$result_set->num_rows == 0) return false;
		return $this->_resultSetToArray($result_set);
	}

	public function SelectString($query, $params = false)	{
		$result_set = $this->connection->query($this->Query($query, $params));
		if(@$result_set->num_rows != 1) return false;
		else return $result_set->fetch_assoc();
	}

	public function SelectCell($query, $params = false)	{
		$result_set = $this->connection->query($this->Query($query, $params));
		if((!$result_set) || ($result_set->num_rows != 1)) return false;
		else {
			$arr = array_values($result_set->fetch_assoc());
			return $arr[0];
		}
	}

	public function Modify($query, $params = false)	{
		$success = $this->connection->query($this->Query($query, $params));
		if($success)	{
			if($this->connection->insert_id === 0) return true;
			else return $this->connection->insert_id;
		}
		else return false;
	}

	private function _resultSetToArray($result_set)	{
		$array = array();
		while(($row = $result_set->fetch_assoc()) != false)	{
			$array[] = $row;
		}
		return $array;
	}
  
	public function __destruct()	{
		if($this->connection) $this->connection->close();
	}     

}