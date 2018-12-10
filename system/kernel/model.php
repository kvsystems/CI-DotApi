<?

namespace Evie\System\Kernel;

use Evie\System\Kernel;
use Evie\System\Config\Config;

class Model extends Kernel {

  const DB_CONF = 'database';
  const SYS_DIR = 'system';
  const DBD_DIR = 'database';
  const DRV_DIR = 'drivers';
  const DRV     = 'driver';
  const FILE_EXT = '.php';

  private $_name   = null;
  private $_driver   = null;
  private $_hostname = null;
  private $_username = null;
  private $_password = null;
  private $_database = null;
  private $_port     = null;
  private $_encrypt  = null;
  protected $db      = null;
    
  public function __construct( $options = array() ) {
    
    parent::__construct();

    $Config = new Config( self::DB_CONF );
    
    $DBConf = $Config::Get();

    $DBGroup = $DBConf['default_group'];
    
    foreach( $DBConf['connections'] as $connection )  {

      $DBConf = array_merge( $connection, $options );
  
      foreach( $DBConf as $Key => $Value ) {   
        
        $Key = implode( array( '_', $Key ) );
        $this->$Key = $Value;
        
      }
  
      $Driver = implode( array(
        ROOT_DIR, self::SYS_DIR, DS, self::DBD_DIR, DS, self::DRV_DIR, DS, 
        "{$this->_driver}/{$this->_driver}_", self::DRV, self::FILE_EXT
      ));
      
      if( file_exists( $Driver ) ) {
        
        $DriverName   = ucfirst( $this->_driver );
        $Namespace     = "Evie\\System\\Database\\Drivers\\{$DriverName}\\{$DriverName}_driver";
  
        $this->db[$connection['name']] = new $Namespace( $connection );        
  
      } else Debug::Message( "Driver {$this->_driver} could not be found." );

    
    }
  
  }

}