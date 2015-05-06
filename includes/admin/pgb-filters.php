<?php

function pgb_filter_save_media_upload($data) {

    if(!is_array($data)) return $data;
    
    foreach ($data as $key => $value) {
        if (is_string($value)) {
            $data[$key] = str_replace(
                array(
                    site_url('', 'http'),
                    site_url('', 'https'),
                ),
                array(
                    '[site_url]',
                    '[site_url_secure]',
                ),
                $value
            );
        }
    }

    return $data;
}
add_filter('pgb_options_before_save', 'pgb_filter_save_media_upload');

/**
 * Filter URLs from uploaded media fields and replaces the site URL keywords
 * with the actual site URL.
 * 
 * @since 1.4.0
 * @param $data Options array
 * @return array
 */
function pgb_filter_load_media_upload($data) {
    
    if(!is_array($data)) return $data;

    foreach ($data as $key => $value) {
        if (is_string($value) && preg_match("/\[site_url(_url_secure)?\]/", $value)) {
            $data[$key] = str_replace(
                array(
                    '[site_url]', 
                    '[site_url_secure]',
                ),
                array(
                    site_url('', 'http'),
                    site_url('', 'https'),
                ),
                $value
            );
        }
    }

    return $data;
}
add_filter('pgb_options_after_load', 'pgb_filter_load_media_upload');
