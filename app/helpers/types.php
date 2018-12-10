<?php

function IsNumber( $number )  {
    
  return is_int( $number ) || is_numeric( $number ) ? true : false;
    
}