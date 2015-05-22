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



/**
 * Filter comments forms to add Bootstrap classes
 * 
 * @since 0.3.0
 * @return html
 */
add_filter( 'comment_form_default_fields', 'progo_bootstrap3_comment_form_fields' );
function progo_bootstrap3_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();

    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;

    $fields   =  array(
        'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name', 'pgb' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
            '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
        'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email', 'pgb' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
            '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
        'url'    => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website', 'pgb' ) . '</label> ' .
            '<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>',
    );

    return $fields;
}

add_filter( 'comment_form_defaults', 'progo_bootstrap3_comment_form' );
function progo_bootstrap3_comment_form( $args ) {
    $args['comment_field']      = '<div class="form-group comment-form-comment"><label for="comment">' . 
                                    _x( 'Comment', 'noun' ) . 
                                    '</label> <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>';
    $args['comment_notes_after']= '<p class="form-allowed-tags">' . 
                                    __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:' ) . 
                                    '</p><div class="alert alert-info">' . 
                                    allowed_tags() . 
                                    '</div>';
    $args['id_form']            = 'commentform';
    $args['id_submit']          = 'commentsubmit';
    $args['title_reply']        = __( 'Leave a Reply', 'pgb' );
    $args['title_reply_to']     = __( 'Leave a Reply to %s', 'pgb' );
    $args['cancel_reply_link']  = __( 'Cancel Reply', 'pgb' );
    $args['label_submit']       = __( 'Post Comment', 'pgb' );

    return $args;
}

