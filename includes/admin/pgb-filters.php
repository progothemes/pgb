<?php

/**
 * Filter comments forms to add Bootstrap classes
 * 
 * @since 0.3.0
 * @return html
 */
add_filter( 'comment_form_default_fields', 'pgb_bootstrap3_comment_form_fields' );
function pgb_bootstrap3_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();

    $req      = get_option( 'require_name_email' );
    $required = ( $req ? ' aria-required="true" required ' : '' );

    $fields   =  array(
        'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name', 'pgb' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
            '<div class="input-group"><span class="input-group-addon glyphicon glyphicon-user"></span><input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $required . ' /></div></div>',
        'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email', 'pgb' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
            '<div class="input-group"><span class="input-group-addon glyphicon glyphicon-envelope"></span><input class="form-control" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $required . ' /></div></div>',
        'url'    => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website', 'pgb' ) . '</label> ' .
            '<div class="input-group"><span class="input-group-addon glyphicon glyphicon-globe"></span><input class="form-control" id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></div>',
    );

    return $fields;
}
add_filter( 'comment_form_defaults', 'pgb_bootstrap3_comment_form' );
function pgb_bootstrap3_comment_form( $args ) {
    $args['comment_field']      = '<div class="form-group comment-form-comment"><label for="comment">' . 
                                    __( 'Comment', 'pgb' ) . 
                                    '</label> <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true" required></textarea></div>';
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

