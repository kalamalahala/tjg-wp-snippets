<?php

add_shortcode('leadership_business_tracker', 'show_leadership_tracker' );

function show_leadership_tracker ( $atts ) {
    $accepted_fields = array (
        'agent_id' => null,
        'downline_agents' => null,
    );
            //pull parameters from shortcode
    $atts = shortcode_atts($accepted_fields, $atts, 'leadership_business_tracker');

            //if agent number wasn't provided, search for current user
    if ( is_null($atts['agent_id']) ) {
		
		$currentUser = get_current_user_id();
		$atts['agent_id'] = get_user_meta( $currentUser, 'agent_number', true );
		
		}
            //set agent number to variable and fix to array for search
    $agent_id = $atts['agent_id'];
    //print_r($agent_id);
    $query_param = array (
        'meta_key' => 'agent_number',
        'meta_value' => $agent_id
    );
                    //get WP User ID from agent number
    $agent_user_id = get_users($query_param);
    //print_r('<h1>agent ID: ' . $agent_user_id . '</h1>');
                    //get position from WP User ID
    $agent_position = get_user_meta( $agent_user_id, 'agent_position', true );
                    //ask for downline meta
    $agent_downline = get_user_meta( $agent_user_id, 'agent_downline', true );
        //check if they had a downline then break it into an array
        if ( isset($agent_downline) ) {
            $explodeDownline = explode ( '|', $agent_downline );
        }
    
                echo(var_dump($agent_id, $agent_user_id, $agent_downline, $agent_position, $explodeDownline));

    switch ($agent_position) {
        case 'Junior Partner':
            $field_to_search = '72';
            $shortcode = '[gravityview id="6385" search_value="' . $agent_id . '" search_field="' . $field_to_search . '"]';
            return $shortcode;
            break;
        case 'Senior Partner':
            $field_to_search = '73';
            $shortcode = '[gravityview id="6385" search_value="' . $agent_id . '" search_field="' . $field_to_search . '"]';
            break;
        case 'Agency Owner':
            return '<h1>create AO shortcode or view </h1>';
            break;
        default:
            return null;
    }


}


?>