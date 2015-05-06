<?php

$theme_version = '';
$pgbo_output = '';
	    
if( function_exists( 'wp_get_theme' ) ) {
	if( is_child_theme() ) {
		$temp_obj = wp_get_theme();
		$theme_obj = wp_get_theme( $temp_obj->get('Template') );
	} else {
		$theme_obj = wp_get_theme();    
	}

	$theme_version = $theme_obj->get('Version');
	$theme_name = $theme_obj->get('Name');
	$theme_uri = $theme_obj->get('ThemeURI');
	$author_uri = $theme_obj->get('AuthorURI');
} else {
	$theme_data = get_theme_data( get_template_directory().'/style.css' );
	$theme_version = $theme_data['Version'];
	$theme_name = $theme_data['Name'];
	$theme_uri = $theme_data['ThemeURI'];
	$author_uri = $theme_data['AuthorURI'];
}



if( !defined('ADMIN_PATH') )
	define( 'ADMIN_PATH', get_template_directory() . '/includes/' );
if( !defined('ADMIN_DIR') )
	define( 'ADMIN_DIR', get_template_directory_uri() . '/includes/' );

define( 'ADMIN_IMAGES', ADMIN_DIR . 'admin/images/' );

define( 'LAYOUT_PATH', ADMIN_PATH . 'layouts/' );
define( 'THEMENAME', $theme_name );
/* Theme version, uri, and the author uri are not completely necessary, but may be helpful in adding functionality */
define( 'THEMEVERSION', $theme_version );
define( 'THEMEURI', $theme_uri );
define( 'THEMEAUTHORURI', $author_uri );

define( 'BACKUPS','backups' );

require_once ( ADMIN_PATH . 'admin/class.pgb_options.php' );
require_once ( ADMIN_PATH . 'admin/functions.load.php' );

add_action('admin_init','progobaseframework_admin_init');
add_action('admin_menu', 'progobaseframework_add_admin');


add_action('wp_ajax_pgb_ajax_post_action', 'pgb_ajax_callback');

add_filter( 'comment_form_default_fields', 'progo_bootstrap3_comment_form_fields' );
function progo_bootstrap3_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();

    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;

    $fields   =  array(
        'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
            '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
        'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
            '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
        'url'    => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' .
            '<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>',
    );

    return $fields;
}

add_filter( 'comment_form_defaults', 'progo_bootstrap3_comment_form' );
function progo_bootstrap3_comment_form( $args ) {
    $args['comment_field']      = '<div class="form-group comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>';
    $args['comment_notes_after']= '<p class="form-allowed-tags">' . __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:' ) . '</p><div class="alert alert-info">' . allowed_tags() . '</div>';
    $args['id_form']            = 'commentform';
    $args['id_submit']          = 'commentsubmit';
    $args['title_reply']        = __( 'Leave a Reply', 'pgb' );
    $args['title_reply_to']     = __( 'Leave a Reply to %s', 'pgb' );
    $args['cancel_reply_link']  = __( 'Cancel Reply', 'pgb' );
    $args['label_submit']       = __( 'Post Comment', 'pgb' );

    return $args;
}

