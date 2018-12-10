<?php
namespace Evie\System\Router;

class Node  {
  
  protected $fragment = null;
  protected $routes   = [];
  protected $children = [];

  public function GetRoutes() {

    return $this->routes;
    
  }

  public function AddRoute( $method, $target ){
    
    $this->routes[$method] = $target;
    
  }

  public function GetRoute( $method ) {
    
    return isset( $this->routes[$method] )
      ? $this->routes[$method] : false;
    
  }

  public function SetFragment( $fragment ) {
      
    $this->fragment = $fragment;
      
  }

  public function GetFragment() {
    
    return $this->fragment;
    
  }

  public function GetChildren() {
    
    return $this->children;
    
  }

  public function AddChild( Node $child ) {

    $this->children[ $child->GetFragment() ] = $child;
    
  }

  public function GetChild( $child ){

    return isset( $this->children[$child] )
      ? $this->children[$child] : false;
      
  }
    
}