<?php
/*
* Admin page for custom theme upload
*
*/

function upload_theme_page() {

?>
  <div class="wrap">
    <h2><?php _e( 'Upload a Custom Bootstrap Theme', 'pgb' ); ?></h2>
    <div id="message" class="updated below-h2">
    </div>
    <form enctype="multipart/form-data" action="" method="post">
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row"><label for="theme-name"><?php _e( 'Name Of The Theme', 'pgb' ); ?></label></th>
            <td><input type="text" id="themename" name="themename" class="regular-text"></td>
          </tr>
          <tr>
            <th scope="row"><label for="inputUpload"><?php _e( 'Upload Theme', 'pgb' ); ?></label></th>
            <td><input type="file" id="inputUpload" name="themeupload"></td>
          </tr>
          <tr>
            <th scope="row"><label></label></th>
            <td><a href="http://getbootstrap.com/customize/" target="_blank"><?php _e( 'Generate and download custom theme here', 'pgb' ); ?></a></td>
          </tr>

        </tbody>
      </table>
      <p class="submit">
        <input type="submit" name="submit" id="upload-theme" class="button button-primary" value="<?php echo esc_attr_x( 'Upload', 'submit button', 'pgb' ); ?>">
      </p>
    </form>
  </div>

  <script type="text/javascript">
      jQuery(document).ready(function($){
        $('#message').css('display','none');
      });
  </script>
<?php

  if(isset($_POST['themename'])) {
    $themename = preg_replace("/[^a-zA-Z]+/", "", $_POST['themename']);
  }
  if(isset($_FILES['themeupload'])) {
    $filename        = $_FILES['themeupload']['name'];
    $source          = $_FILES['themeupload']['tmp_name'];
    $type            = $_FILES['themeupload']['type']; 
    $Name            = explode('.', $filename); 
    $destination     = wp_upload_dir();
    $destination_dir = $destination['basedir'];
    $destination_dir = $destination_dir . '/bootstrapthemes';

    if (! is_dir($destination_dir)) {
       mkdir( $destination_dir, 0755 );
    }
    
    $destination_dir     = $destination_dir . '/'.$themename;
    $saved_file_location = $destination_dir . $filename;

    if (move_uploaded_file($source, $saved_file_location)) 
    {
      $zip = new ZipArchive;
      if ($zip->open($saved_file_location) === TRUE) {
          $zip->extractTo($destination_dir);
          $zip->close();
          echo "<script>
          jQuery(document).ready(function($){
            $('#message').css('display', 'block').html('<p>Successfully unzipped the file and set as current theme!</p>');
          });
          </script>";
          unlink($saved_file_location);     
		  pgb_save_options($themename,'bootstrap_theme');
      } else {
          echo "<script>
          jQuery(document).ready(function($){
            $('#message').css('display', 'block').html('<p>There was an error unzipping the file.</p>');
            $('div.updated').css('border-color', '#b73b27');
          });
          </script>";  
      }
    } 
    else 
    {
        die("<script>
          jQuery(document).ready(function($){
            $('#message').css('display', 'block').html('<p>There was a problem with the upload. Plese verify you have uploaded a valid zip file.</p>');
            $('div.updated').css('border-color', '#b73b27');
          });
          </script>");
    }
  }

}