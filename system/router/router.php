<?php
namespace Evie\System\Router;

use Evie\System\Router\Node;

class Router {

  const METHOD_GET    = "GET";
  const METHOD_POST   = "POST";

  protected $nodes    = null;

  function __construct()  {
    
    $this->nodes = new Node();
    
  }

  public function Get( $route, $resource )  {    

    $this->Add( $route, $resource, self::METHOD_GET );
    
  }

  public function Add( $route, $resource, $method = self::METHOD_GET ) {

    switch( $method ) {
      
      case self::METHOD_POST: $method = self::METHOD_POST; break;
      default: $method = self::METHOD_GET;  
    
    }

    $Route = trim( $route, "/" );

    $Fragments = explode( "/", $Route );
    
    if( count( $Fragments ) === 1 && $Fragments[0] == "" )
      $Fragments[0] = "/";

    $Parent = $this->nodes;

    foreach( $Fragments as $Piece ) {    
      
      if( $Node = $Parent->GetChild( $Piece ) ) {
        
        $Parent = $Node;
        
      } else {
        
        $Node = new Node();
        $Node->SetFragment( $Piece );
        $Parent->AddChild( $Node );
        $Parent = $Node;
        
      }
        
    }

    $Parent->AddRoute( $method, $resource );
    
  }

  public function Match( $route, $method = self::METHOD_GET ) {

    if( !is_array( $route ) ) {
            
      $Route = trim( $route, "/" );
      $Route = explode( "/", $Route );

      if( count( $Route ) === 1 && $Route[0] == "" )
        $Route[0] = "/";
                
    } else if( empty( $Route ) ) $Route = ["/"];
    
    $Node = $this->nodes;
    $Params = [];

    foreach( $Route as $Fragment )  {

      $Child = $Node->GetChild( $Fragment );

      if( $Child === false )  {

        $Child = $Node->GetChild( "(:any)" );         
        if($Child === false) return false;
        $Params[] = $Fragment;
        
      }

      $Node = $Child;
            
    }

    $Routes = $Node->GetRoutes();
    
    if( isset( $Routes[$method] ) ) {
    
      $Route = explode( "@", $Routes[$method] );

      if( count($Route) == 3 )  {
        
        $Route = [
          "module"        => $Route[0],
          "controller"    => $Route[1],
          "action"        => $Route[2],
          "params"        => $Params
        ];
        
      } else {
        
        $Route = [
          "controller"    => $Route[0],
          "action"        => $Route[1],
          "params"        => $Params
        ];
        
      }

      return $Route;
            
    } else return count( $Routes ) > 0 ? true : false;    

  }
  
}