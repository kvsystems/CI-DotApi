<?php

function Redirect( $location = '' ) {
    
    global $config;
    header( 'Location: '. $config['config']['base_url'] . $location );
    
}

