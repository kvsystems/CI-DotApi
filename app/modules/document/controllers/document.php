<?php

namespace Evie\App\Modules\Document\Controllers;

use Evie\System\Kernel\Controller;
use Evie\System\Kernel\Loader;
use Evie\App\Core\AppController;

class Document extends Controller  {

    protected $rest = null;
    protected $dirs = null;
    protected $header = null;

  public function __construct() {
      
    parent::__construct();
    
    $this->dirs   = AppController::GetDirs();
    $this->rest   = Loader::Library( 'rest' );
    $this->header = Loader::Library( 'header' );

  }

  public function Style() {

    $File = $this->dirs['styles'] . strip_tags( $this->Get( 'file' ) );

    $Data = is_file( $File ) ? file_get_contents( $File ) : null;

    if( !is_null( $Data ) ) {
      
      $Response = $this->header->Response( $Data,  $this->header->Get( 'CSS' ) );
      
    } else {
    
      $Response = $this->rest->Response(
        ['status' => 'error', 'message' => "File not found" ],
        $this->rest->GetStatus('HTTP_NOT_FOUND')          
      );
    
    }
    
    return $Response;
    
  }
  
  public function Script()  {
  
    $File = $this->dirs['scripts'] . strip_tags( $this->Get( 'file' ) );

    $Data = is_file( $File ) ? file_get_contents( $File ) : null;

    if( !is_null( $Data ) ) {
      
      
      $Response = $this->header->Response( $Data, $this->header->Get( 'JS' ) );
      
    } else {
    
      $Response = $this->rest->Response(
        ['status' => 'error', 'message' => "File not found" ],
        $this->rest->GetStatus('HTTP_NOT_FOUND')
      );
    
    }
    
    return $Response;
  
  }
  
  public function Library() {
  
    $File = $this->dirs['libraries'] . str_replace( '|', '/', $this->Get( 'path' ) );

    $Type = $this->Get( 'type' ) == 1 ? 'JS' : 'CSS' ;

    $Data = is_file( $File ) ? file_get_contents( $File ) : null;

    if( !is_null( $Data ) ) {
      
      $Response = $this->header->Response( $Data,  $this->header->Get( $Type ) );
      
    } else {
    
      $Response = $this->rest->Response(
        ['status' => 'error', 'message' => "Path not found" ],
        $this->rest->GetStatus('HTTP_NOT_FOUND')
      );
    
    }
    
    return $Response;
  
  }
  
  public function Font()  {
      
    $File = $this->dirs['fonts'] . explode( '?', $this->Route['params'][0])[0];
    $Type = $this->Get( 'type' ) == 1 ? 'JS' : 'CSS' ;

    $Data = is_file( $File ) ? file_get_contents( $File ) : null;

    if( !is_null( $Data ) ) {
      
      $Response = $this->header->Response( $Data,  $this->header->Get( 'AUTO' ) );
      
    } else {
    
      $Response = $this->rest->Response(
        ['status' => 'error', 'message' => "Path not found" ],
        $this->rest->GetStatus('HTTP_NOT_FOUND')
      );
    
    }
    
    return $Response;    
  
  }
  
  public function Image()  {
      
    $File = $this->dirs['image'] . strip_tags( $this->Get( 'file' ) );

    $Data = is_file( $File ) ? file_get_contents( $File ) : null;

    if( !is_null( $Data ) ) {
            
      $Response = $this->header->Response( $Data, 'AUTO' );
      
    } else {
    
      $Response = $this->rest->Response(
        ['status' => 'error', 'message' => "Image not found" ],
        $this->rest->GetStatus('HTTP_NOT_FOUND')
      );
    
    }
    
    return $Response; 
  
  }
  
}