<?php

/**
 * Set states depending on country selected
 */
add_action( 'wp_ajax_twx_get_states', 'twx_get_states' );
add_action( 'wp_ajax_nopriv_twx_get_states', 'twx_get_states' );

function twx_get_states() {
    check_ajax_referer('twx_ajax_nonce', 'nonce_ajax');
    
    $result['success'] = false;
    
    $country_code = $_POST['country_code'];
    
    if ( isset( $country_code ) && !empty($country_code) ) {
        $states = WC()->countries->get_states($country_code);
        if ( !is_wp_error( $states ) ) {
            
            // Default state data values
            $city = __( 'City', 'twx-woo-cf7' );
            $city_opt = '';
            $state_title = __( 'Region / Department', 'twx-woo-cf7' );
            $state_placeholder = __( 'Choose an option', 'twx-woo-cf7' );
            $state_opt = '';
            $state_tag = '';
            $zip_title = __( 'ZIP code', 'twx-woo-cf7' );
            $zip_opt = '';
            $optional = __( '(optional)', 'twx-woo-cf7' );
            
            // Update data values depending on country
            switch ($country_code) {
                case 'AF':
                    $state_title = 'none';
                    break;
                case 'AX':
                    $state_title = 'none';
                    break;
                case 'ZA':
                    $state_title = __( 'Province', 'twx-woo-cf7' );
                    break;
                case 'AL':
                    $state_title = __( 'Department', 'twx-woo-cf7' );
                    break;
                case 'DE':
                    $state_title = 'none';
                    break;
                case 'AS':
                    $state_tag = 'text';
                    break;
                case 'AD':
                    $state_tag = 'text';
                    break;
                case 'AO':
                    $state_title = __( 'Province', 'twx-woo-cf7' );
                    $zip_opt = 'none';
                    break;
                case 'AI':
                    $state_tag = 'text';
                    break;
                case 'AQ':
                    $state_tag = 'text';
                    break;
                case 'AG':
                    $state_tag = 'text';
                    break;
                case 'SA':
                    $state_tag = 'text';
                    break;
                case 'AM':
                    $state_tag = 'text';
                    break;
                case 'AW':
                    $state_tag = 'text';
                    break;
                case 'AU':
                    $state_title = __( 'State', 'twx-woo-cf7' );
                    break;
                case 'AT':
                    $state_title = 'none';
                    break;
                case 'AZ':
                    $state_tag = 'text';
                    break;
                case 'BS':
                    $state_tag = 'text';
                    $zip_opt = 'none';
                    break;
                case 'BH':
                    $state_title = 'none';
                    $zip_opt = 'option';
                    break;
                case 'BD':
                    $state_title = __( 'District', 'twx-woo-cf7' );
                    $zip_opt = 'option';
                    break;
                case 'BB':
                    $state_tag = 'text';
                    break;
                case 'PW':
                    $state_tag = 'text';
                    break;
                case 'BE':
                    $state_title = 'none';
                    break;
                case 'BZ':
                    $state_tag = 'text';
                    break;
                case 'BM':
                    $state_tag = 'text';
                    break;
                case 'BT':
                    $state_tag = 'text';
                    break;
                case 'BY':
                    $state_tag = 'text';
                    break;
                case 'BO':
                    $state_title = __( 'Domain', 'twx-woo-cf7' );
                    $zip_opt = 'none';
                    break;
                case 'BA':
                    $state_title = __( 'Canton', 'twx-woo-cf7' );
                    $state_tag = 'text';
                    break;
                case 'BW':
                    $state_tag = 'text';
                    break;
                case 'BN':
                    $state_tag = 'text';
                    break;
                case 'BF':
                    $state_tag = 'text';
                    break;
                case 'BI':
                    $state_title = 'none';
                    break;
                case 'KH':
                    $state_tag = 'text';
                    break;
                case 'CM':
                    $state_tag = 'text';
                    break;
                case 'CA':
                    $state_title = __( 'Province', 'twx-woo-cf7' );
                    break;
                case 'CM':
                    $state_tag = 'text';
                    break;
                case 'CL':
                    $state_title = __( 'Region', 'twx-woo-cf7' );
                    $zip_opt = 'option';
                    break;
                case 'CN':
                    $state_title = __( 'Province', 'twx-woo-cf7' );
                    break;
                case 'CX':
                    $state_tag = 'text';
                    break;
                case 'CY':
                    $state_tag = 'text';
                    break;
                case 'CO':
                    $state_title = __( 'Domain', 'twx-woo-cf7' );
                    $zip_opt = 'option';
                    break;
                case 'KM':
                    $state_tag = 'text';
                    break;
                case 'CG':
                    $state_tag = 'text';
                    break;
                case 'CD':
                    $state_tag = 'text';
                    break;
                case 'KP':
                    $state_tag = 'text';
                    break;
                case 'KR':
                    $state_title = 'none';
                    break;
                case 'CR':
                    $state_title = __( 'Province', 'twx-woo-cf7' );
                    break;
                case 'CI':
                    $state_tag = 'text';
                    break;
                case 'HR':
                    $state_tag = 'text';
                    break;
                case 'CU':
                    $state_tag = 'text';
                    break;
                case 'CW':
                    $state_tag = 'text';
                    $zip_opt = 'none';
                    break;
                case 'DK':
                    $state_title = 'none';
                    break;
                case 'DJ':
                    $state_tag = 'text';
                    break;
                case 'DM':
                    $state_tag = 'text';
                    break;
                case 'AE':
                    $state_tag = 'text';
                    $zip_opt = 'none';
                    break;
                case 'DK':
                    $state_title = __( 'Province', 'twx-woo-cf7' );
                    break;
                case 'ER':
                    $state_tag = 'text';
                    break;
                case 'ES':
                    $state_title = __( 'Province', 'twx-woo-cf7' );
                    break;
                case 'EE':
                    $state_title = 'none';
                    break;
                case 'US':
                    $state_title = __( 'State', 'twx-woo-cf7' );
                    break;
                case 'ET':
                    $state_tag = 'text';
                    break;
                case 'FJ':
                    $state_tag = 'text';
                    break;
                case 'FI':
                    $state_title = 'none';
                    break;
                case 'FR':
                    $state_title = 'none';
                    break;
                case 'GA':
                    $state_tag = 'text';
                    break;
                case 'GM':
                    $state_tag = 'text';
                    break;
                case 'GE':
                    $state_tag = 'text';
                    break;
                case 'GS':
                    $state_tag = 'text';
                    break;
                case 'GH':
                    $state_tag = __( 'Region', 'twx-woo-cf7' );
                    $zip_opt = 'option';
                    break;
                case 'GI':
                    $state_tag = 'text';
                    break;
                case 'GD':
                    $state_tag = 'text';
                    break;
                case 'GL':
                    $state_tag = 'text';
                    break;
                case 'GP':
                    $state_title = 'none';
                    break;
                case 'GT':
                    $state_tag = 'text';
                    break;
                case 'GU':
                    $state_title = __( 'Domain', 'twx-woo-cf7' );
                    $zip_opt = 'none';
                    break;
                case 'GG':
                    $state_tag = 'text';
                    break;
                case 'GN':
                    $state_tag = 'text';
                    break;
                case 'GQ':
                    $state_tag = 'text';
                    break;
                case 'GW':
                    $state_tag = 'text';
                    break;
                case 'GY':
                    $state_tag = 'text';
                    break;
                case 'GF':
                    $state_title = 'none';
                    break;
                case 'HT':
                    $state_tag = 'text';
                    break;
                case 'HN':
                    $state_title = __( 'Domain', 'twx-woo-cf7' );
                    break;
                case 'HK':
                    $state_title = __( 'Region', 'twx-woo-cf7' );
                    $zip_opt = 'none';
                    break;
                case 'HU':
                    $state_title = __( 'Department', 'twx-woo-cf7' );
                    break;
                case 'BV':
                    $state_tag = 'text';
                    break;
                case 'IM':
                    $state_title = 'none';
                    break;
                case 'NF':
                    $state_tag = 'text';
                    break;
                case 'KY':
                    $state_tag = 'text';
                    break;
                case 'CC':
                    $state_tag = 'text';
                    break;
                case 'CK':
                    $state_tag = 'text';
                    break;
                case 'FK':
                    $state_tag = 'text';
                    break;
                case 'HM':
                    $state_tag = 'text';
                    break;
                case 'MH':
                    $state_tag = 'text';
                    break;
                case 'SB':
                    $state_tag = 'text';
                    break;
                case 'TC':
                    $state_tag = 'text';
                    break;
                case 'IN':
                    $state_title = __( 'State', 'twx-woo-cf7' );
                    $zip_title = __( 'Pin code', 'twx-woo-cf7' );
                    break;
                case 'IN':
                    $state_title = __( 'Province', 'twx-woo-cf7' );
                    break;
                case 'IR':
                    $state_title = __( 'Province', 'twx-woo-cf7' );
                    break;
                case 'IQ':
                    $state_tag = 'text';
                    break;
                case 'IE':
                    $state_title = __( 'Department', 'twx-woo-cf7' );
                    $zip_title = __( 'Eircode', 'twx-woo-cf7' );
                    $zip_opt = 'option';
                    break;
                case 'IS':
                    $state_title = 'none';
                    break;
                case 'IL':
                    $state_title = 'none';
                    break;
                case 'IT':
                    $state_title = __( 'Province', 'twx-woo-cf7' );
                    break;
                case 'JM':
                    $city = __( 'City / Post office', 'twx-woo-cf7' );
                    $state_title = __( 'Town', 'twx-woo-cf7' );
                    $zip_opt = 'option';
                    break;
                case 'JP':
                    $state_title = __( 'Prefecture', 'twx-woo-cf7' );
                    break;
                case 'JE':
                    $state_tag = 'text';
                    break;
                case 'JO':
                    $state_tag = 'text';
                    break;
                case 'KZ':
                    $state_tag = 'text';
                    break;
                case 'KI':
                    $state_tag = 'text';
                    break;
                case 'KW':
                    $state_title = 'none';
                    break;
                case 'KG':
                    $state_tag = 'text';
                    break;
                case 'RE':
                    $state_title = 'none';
                    break;
                case 'LS':
                    $state_tag = 'text';
                    break;
                case 'LV':
                    $state_title = __( 'Municipality', 'twx-woo-cf7' );
                    $state_tag = 'text';
                    break;
                case 'LB':
                    $state_title = 'none';
                    break;
                case 'LY':
                    $state_tag = 'text';
                    break;
                case 'LI':
                    $state_title = __( 'Municipality', 'twx-woo-cf7' );
                    $state_tag = 'text';
                    break;
                case 'LT':
                    $state_tag = 'text';
                    break;
                case 'LU':
                    $state_title = 'none';
                    break;
                case 'MO':
                    $state_tag = 'text';
                    break;
                case 'MK':
                    $state_tag = 'text';
                    break;
                case 'MG':
                    $state_tag = 'text';
                    break;
                case 'MW':
                    $state_tag = 'text';
                    break;
                case 'MV':
                    $state_tag = 'text';
                    break;
                case 'ML':
                    $state_tag = 'text';
                    break;
                case 'MT':
                    $state_title = 'none';
                    break;
                case 'MA':
                    $state_tag = 'text';
                    break;
                case 'MQ':
                    $state_title = 'none';
                    break;
                case 'MU':
                    $state_tag = 'text';
                    break;
                case 'MR':
                    $state_tag = 'text';
                    break;
                case 'YT':
                    $state_title = 'none';
                    break;
                case 'FM':
                    $state_tag = 'text';
                    break;
                case 'MD':
                    $state_title = __( 'Municipality / District', 'twx-woo-cf7' );
                    break;
                case 'MC':
                    $state_tag = 'text';
                    break;
                case 'MN':
                    $state_tag = 'text';
                    break;
                case 'ME':
                    $state_tag = 'text';
                    break;
                case 'MS':
                    $state_tag = 'text';
                    break;
                case 'MZ':
                    $state_title = __( 'Province', 'twx-woo-cf7' );
                    $zip_opt = 'none';
                    break;
                case 'MM':
                    $state_tag = 'text';
                    break;
                case 'NR':
                    $state_tag = 'text';
                    break;
                case 'NP':
                    $state_title = __( 'State', 'twx-woo-cf7' );
                    $zip_opt = 'option';
                    break;
                case 'NI':
                    $state_title = __( 'Domain', 'twx-woo-cf7' );
                    break;
                case 'NE':
                    $state_tag = 'text';
                    break;
                case 'NG':
                    $state_title = __( 'State', 'twx-woo-cf7' );
                    $zip_opt = 'none';
                    break;
                case 'NU':
                    $state_tag = 'text';
                    break;
                case 'MP':
                    $state_tag = 'text';
                    break;
                case 'NO':
                    $state_title = 'none';
                    break;
                case 'NC':
                    $state_tag = 'text';
                    break;
                case 'NZ':
                    $state_title = __( 'Region', 'twx-woo-cf7' );
                    break;
                case 'OM':
                    $state_tag = 'text';
                    break;
                case 'PA':
                    $state_title = __( 'Province', 'twx-woo-cf7' );
                    break;
                case 'PG':
                    $state_tag = 'text';
                    break;
                case 'PY':
                    $state_title = __( 'Province', 'twx-woo-cf7' );
                    break;
                case 'NL':
                    $state_title = 'none';
                    break;
                case 'PN':
                    $state_tag = 'text';
                    break;
                case 'PL':
                    $state_title = 'none';
                    break;
                case 'PF':
                    $state_tag = 'text';
                    break;
                case 'PT':
                    $state_title = 'none';
                    break;
                case 'PR':
                    $city = __( 'Municipality', 'twx-woo-cf7' );
                    $state_title = 'none';
                    break;
                case 'QA':
                    $state_tag = 'text';
                    break;
                case 'CF':
                    $state_tag = 'text';
                    break;
                case 'DO':
                    $state_title = __( 'Province', 'twx-woo-cf7' );
                    break;
                case 'CZ':
                    $state_title = 'none';
                    break;
                case 'RO':
                    $state_title = __( 'Department', 'twx-woo-cf7' );
                    $state_opt = 'required';
                    break;
                case 'GB':
                    $state_tag = 'text';
                    break;
                case 'RU':
                    $state_tag = 'text';
                    break;
                case 'RW':
                    $state_tag = 'text';
                    break;
                case 'BQ':
                    $state_tag = 'text';
                    break;
                case 'EH':
                    $state_tag = 'text';
                    break;
                case 'BL':
                    $state_tag = 'text';
                    break;
                case 'PM':
                    $state_tag = 'text';
                    break;
                case 'KN':
                    $state_tag = 'text';
                    break;
                case 'MF':
                    $state_tag = 'text';
                    break;
                case 'SX':
                    $state_tag = 'text';
                    break;
                case 'VC':
                    $state_tag = 'text';
                    break;
                case 'SH':
                    $state_tag = 'text';
                    break;
                case 'LC':
                    $state_tag = 'text';
                    break;
                case 'SV':
                    $state_title = __( 'Domain', 'twx-woo-cf7' );
                    break;
                case 'WS':
                    $zip_opt = 'none';
                    break;
                case 'SM':
                    $state_tag = 'text';
                    break;
                case 'ST':
                    $state_title = __( 'District', 'twx-woo-cf7' );
                    $zip_opt = 'none';
                    break;
                case 'SN':
                    $state_tag = 'text';
                    break;
                case 'RS':
                    $state_title = __( 'District', 'twx-woo-cf7' );
                    break;
                case 'SC':
                    $state_tag = 'text';
                    break;
                case 'SC':
                    $state_tag = 'text';
                    break;
                case 'SL':
                    $state_tag = 'text';
                    break;
                case 'SG':
                    $city_opt = 'option';
                    $state_title = 'none';
                    break;
                case 'SK':
                    $state_title = 'none';
                    break;
                case 'SI':
                    $state_title = 'none';
                    break;
                case 'SO':
                    $state_tag = 'text';
                    break;
                case 'SD':
                    $state_tag = 'text';
                    break;
                case 'SS':
                    $state_tag = 'text';
                    break;
                case 'LK':
                    $state_title = 'none';
                    break;
                case 'CH':
                    $state_title = __( 'Canton', 'twx-woo-cf7' );
                    break;
                case 'LK':
                    $state_title = 'none';
                    break;
                case 'SR':
                    $state_tag = 'text';
                    $zip_opt = 'none';
                    break;
                case 'SJ':
                    $state_tag = 'text';
                    break;
                case 'SZ':
                    $state_tag = 'text';
                    break;
                case 'SY':
                    $state_tag = 'text';
                    break;
                case 'TW':
                    $state_tag = 'text';
                    break;
                case 'TJ':
                    $state_tag = 'text';
                    break;
                case 'TD':
                    $state_tag = 'text';
                    break;
                case 'TF':
                    $state_tag = 'text';
                    break;
                case 'IO':
                    $state_tag = 'text';
                    break;
                case 'PS':
                    $state_tag = 'text';
                    break;
                case 'TL':
                    $state_tag = 'text';
                    break;
                case 'TG':
                    $state_tag = 'text';
                    break;
                case 'TK':
                    $state_tag = 'text';
                    break;
                case 'TO':
                    $state_tag = 'text';
                    break;
                case 'TT':
                    $state_tag = 'text';
                    break;
                case 'TN':
                    $state_tag = 'text';
                    break;
                case 'TM':
                    $state_tag = 'text';
                    break;
                case 'TR':
                    $state_title = __( 'Province', 'twx-woo-cf7' );
                    break;
                case 'TV':
                    $state_tag = 'text';
                    break;
                case 'UG':
                    $state_title = __( 'District', 'twx-woo-cf7' );
                    $state_opt = 'required';
                    $zip_opt = 'none';
                    break;
                case 'UY':
                    $state_title = __( 'Domain', 'twx-woo-cf7' );
                    break;
                case 'UZ':
                    $state_tag = 'text';
                    break;
                case 'VU':
                    $state_tag = 'text';
                    break;
                case 'VA':
                    $state_tag = 'text';
                    break;
                case 'VN':
                    $state_title = 'none';
                    $zip_opt = 'option';
                    break;
                case 'VG':
                    $state_tag = 'text';
                    break;
                case 'VI':
                    $state_tag = 'text';
                    break;
                case 'WF':
                    $state_tag = 'text';
                    break;
                case 'YE':
                    $state_tag = 'text';
                    break;
                case 'VN':
                    $zip_opt = 'none';
                    break;
            }
            
            $result['success']      = true;
            $result['states']       = $states;
            $result['state_data']   = [
                    'city'              => $city,
                    'city_opt'          => $city_opt,
                    'state_title'       => $state_title,
                    'state_placeholder' => $state_placeholder,
                    'state_opt'         => $state_opt,
                    'state_tag'         => $state_tag,
                    'zip_opt'           => $zip_opt,
                    'zip_title'         => $zip_title,
                    'optional'          => $optional,
                ];
        }
    }
    echo json_encode( $result );
    exit;
}

?>