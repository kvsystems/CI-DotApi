<?php

class Header  {

  const CSS  = 'text/css';
  const JS   = 'application/javascript';
  const HTML = 'text/html';

  private $_types = [
    'CSS'  => self::CSS,
    'JS'   => self::JS,
    'HTML' => self::HTML,
    'AUTO' => null
  ];

  public function Response( $data, $type = self::HTML )  {
  
    if( !is_null( $type ) ) header('Content-Type: ' . $type );
    
    echo $data;
      
  }
  
  public function Get( $type )  {
    
    return $this->_types[$type]
      ? $this->_types[$type]
      : $this->_types['HTML'];

  }
    
}