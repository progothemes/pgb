<?php
if ( ! function_exists( 'progo_news' ) ) {

    function progo_news(){
        global $wpdb;

        /*
         * We'll set the default character set and collation for this table.
         * If we don't do this, some characters could end up being converted 
         * to just ?'s when saved in our table.
         */
        $table_name      = $wpdb->prefix . 'news';
        $charset_collate = '';

        if ( ! empty( $wpdb->charset ) ) {
          $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
        }

        if ( ! empty( $wpdb->collate ) ) {
          $charset_collate .= " COLLATE {$wpdb->collate}";
        }

        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
          $sql = "CREATE TABLE $table_name (
            news_id int NOT NULL,
            time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            news text NOT NULL,
            mark boolean DEFAULT '0' NOT NULL,
            UNIQUE KEY news_id (news_id)
          ) $charset_collate;";

          require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
          dbDelta( $sql );
        }

        $news = wp_remote_get( 'http://localhost/sneha/generated.json', array( 'timeout' => 120) );
        $json_data = json_decode($news['body'], true);
        if( is_array($json_data)) {
          foreach ($json_data as $jsondata) {

            $news_id = $jsondata['id'];
            $news    = $jsondata['body'];
            $time    = $jsondata['created'];

            $sql = "INSERT INTO {$table_name} (news_id, news, time) VALUES (%d, %s, %s) ON DUPLICATE KEY UPDATE news_id = %d, news = %s";
            $sql = $wpdb->prepare($sql,$news_id,$news,$time,$news_id,$news) ;
            $wpdb->query($sql);

          }
        }
        $newsAll    = $wpdb->get_results( "SELECT * FROM $table_name");
        $newsUnread = $wpdb->get_results( "SELECT * FROM $table_name WHERE mark = 0");
        $newsRead   = $wpdb->get_results( "SELECT * FROM $table_name WHERE mark = 1");

        $url = explode("&", $_SERVER['REQUEST_URI']);
        ?>
            <div class="wrap custom-news">
                <h2><?php _e( 'Current News', 'pgb'); ?></h2>
                <?php if ( empty($newsAll) ) { ?>
                <div id="message" class="updated below-h2">
                    <p>There is no current news.</p>
                </div>
                <?php } else { ?>
                <ul class="subsubsub">
                    <li id="all"><a href="<?php echo esc_url( $url[0].'&all=true' ); ?>"><?php _e( 'All', 'pgb' ); ?></a> | </li>
                    <li id="unmark"><a href="<?php echo esc_url( $url[0].'&unmark=true' ); ?>"><?php _e( 'Unread', 'pgb' ); ?></a> | </li>
                    <li id="mark"><a href="<?php echo esc_url( $url[0].'&mark=true' ); ?>"><?php _e( 'Read', 'pgb' ); ?></a></li>
                </ul>
                <table class="wp-list-table widefat fixed posts">
                    <thead>
                        <tr>
                            <th class="manage-column column-date asc"><?php _e( 'Date and Time', 'pgb' ); ?></th>
                            <th class="manage-column column-title desc"><?php _e( 'Contents', 'pgb' ); ?></th> 
                            <th class="manage-column column-date desc"><?php _e( 'Mark As', 'pgb' ); ?></th>
                        </tr>
                    </thead>
                    <tbody id="the-list">
                    <?php 
                        if(isset($_GET['all'])) {
                          $newsData = $newsAll;
                          $class="all";
                        } elseif(isset($_GET['unmark'])) {
                          $newsData = $newsUnread;
                          $class="unmark";
                        } elseif(isset($_GET['mark'])) {
                          $newsData = $newsRead;
                          $class="mark";
                        } else {
                          $newsData = $newsUnread;
                          $class="unmark";
                        } 
                          $news = $newsData;
                          foreach ($news as $newsdata) { 
                    ?>
                        <tr class="<?php echo 'mark-'.$newsdata->mark; ?> news-list" mark="<?php echo $class; ?>">
                            <td><?php echo $newsdata->time; ?></td>
                            <td class="news-text"><?php echo $newsdata->news; ?></td>
                            <?php if ($newsdata->mark == 1 ) { ?> 
                            <td id="<?php echo $newsdata->news_id; ?>" class="mark-button"><a href="#" class="button media-button button-large  select-mode-toggle-button delete" style="display: inline-block;"><?php _e( 'Delete', 'pgb' ); ?></a></td>
                            <?php } else { ?>
                            <td id="<?php echo $newsdata->news_id; ?>" class="mark-button"><a href="#" class="button media-button button-large  select-mode-toggle-button mark-as-red" style="display: inline-block;"><?php _e( 'Mark As Read', 'pgb' ); ?></a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <?php } ?>
          </div>
          <script type="text/javascript">
            jQuery(document).ready(function($){
                $('tr.mark-1').css('background', '#F3CDCD');
                
                $(".mark-as-red").click(function(){
                    var mark = $(this).closest( "tr" ).attr("mark");
                    if (mark == 'all') {
                        $(this).closest( "tr" ).css('background', '#F3CDCD');
                        $(this).removeClass('mark-as-red').addClass('delete');
                        $(this).html('Delete');
                    } else if(mark == 'unmark') {
                        $(this).closest( "tr" ).remove();
                    }
                    var parentid = $(this).parent().attr('id');
                    var data = {
                      'action': 'action_update',
                      'news_id': parentid 
                    };
                    $.post('admin-ajax.php', data, function(response) { 
                    });
                });

              $(".delete").click(function(){
                $(this).closest( "tr" ).css("display","none");
                var parentid = $(this).parent().attr('id');
                var data = {
                  'action': 'action_delete',
                  'news_id': parentid 
                };
                $.post('admin-ajax.php', data, function(response) { 
                });
              });
            
            });
          </script>
      <?php
  }


  add_action( 'wp_ajax_action_update', 'action_update' );

    function action_update() {
        global $wpdb;
        $id = intval( $_POST['news_id'] );
        $wpdb->update( 
        $wpdb->prefix.'news', 
        array( 
          'mark' => 1,
        ),
        array( 'news_id' => $id )
        );
        die();
    }

    add_action( 'wp_ajax_action_delete', 'action_delete' );

    function action_delete() {
        global $wpdb;
        $id = intval( $_POST['news_id'] );
        $wpdb->delete( $wpdb->prefix.'news', array( 'news_id' => $id ) );
        die();
    }
	/*
    function deactivationfunction() {
        global $wpdb;
        $sql = "DROP TABLE ".$wpdb->prefix.'news';
        $wpdb->query($sql); 
    }

    add_action("switch_theme", "deactivationfunction", 10 , 2);
	*/
}