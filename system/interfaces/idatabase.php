<?php

namespace Evie\System\Interfaces;

interface IDatabase {
    
  public function Select( $table, $condition = null );
  public function Delete( $table, $id=null );
  public function Update( $table, array $data, array $condition );
  public function Insert( $table, $data );
  public function Add( $table, array $data, array $condition );

}