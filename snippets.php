<?php

add_shortcode( 'get_quality_links', 'quality_links' );

function quality_links ( ) {

    $current_user = get_current_user_id( );
    $agent_position = get_user_meta( $current_user, 'agent_position', true );
    $admin_positions = array('Agency Owner', 'Quality Manager', 'Administrator');

    if ( in_array( $agent_position, $admin_positions, false ) ) {
        return "add button html and such here";
    }
}

?>