<?php
/*
Plugin Name: Multi logo 
Plugin URI: https://amrezzat.me
Description: Multi Logo for WPML
Version: 1.0
Author: Amr Ezzat
*/
  function wptuts_options_init() {
    $wptuts_options = get_option( 'theme_wptuts_options' );
    $GLOBALS['wptuts_options'] = get_option( 'theme_wptuts_options' );
    // Are our options saved in the DB?
    if ( false === $wptuts_options ) {
        // If not, we'll save our default options
        //$wptuts_options = wptuts_get_default_options();
        add_option( 'theme_wptuts_options', $wptuts_options );
    }
 
    // In other case we don't need to update the DB
}
 
// Initialize Theme options
add_action( 'after_setup_theme', 'wptuts_options_init' );
// Add "WPTuts Options" link to the "Appearance" menu
function wptuts_menu_options() {
    // add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function);
    add_theme_page('Multi Logo', 'Multi Logo', 'edit_theme_options', 'wptuts-settings', 'wptuts_admin_options_page');
}
// Load the Admin Options page
add_action('admin_menu', 'wptuts_menu_options');

function wptuts_admin_options_page() {
     ?>
        <!-- 'wrap','submit','icon32','button-primary' and 'button-secondary' are classes
        for a good WP Admin Panel viewing and are predefined by WP CSS -->
 
        <div class="wrap">
 
            <div id="icon-themes" class="icon32"><br /></div>
 
            <h2><?php _e( 'Multi Logo', 'wptuts' ); ?></h2>
 
            <!-- If we have any error by submiting the form, they will appear here -->
            <?php settings_errors( 'wptuts-settings-errors' ); ?>
 
            <form id="form-wptuts-options" action="options.php" method="post" enctype="multipart/form-data">
 
                <?php
                    settings_fields('theme_wptuts_options');
                    do_settings_sections('wptuts');
                ?>
 
                <p class="submit">
                    <input name="theme_wptuts_options[submit]" id="submit_options_form" type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'wptuts'); ?>" />
                    <input name="theme_wptuts_options[reset]" type="submit" class="button-secondary" value="<?php esc_attr_e('reset', 'wptuts'); ?>" />
                </p>
 
            </form>
 
        </div>
    <?php
}

function wptuts_options_settings_init() {
    register_setting( 'theme_wptuts_options', 'theme_wptuts_options', 'wptuts_options_validate' );
 
    // Add a form section for the Logo
    add_settings_section('wptuts_settings_header', __( 'Setup Multi Logo', 'wptuts' ), 'wptuts_settings_header_text', 'wptuts');
 
    // Add Logo uploader
    add_settings_field('wptuts_setting_logo',  __( 'English Logo  ', 'wptuts' ), 'wptuts_setting_logo', 'wptuts', 'wptuts_settings_header');
    add_settings_field('wptuts_setting_logo2',  __( 'Arabic logo', 'wptuts' ), 'wptuts_setting_logo2', 'wptuts', 'wptuts_settings_header');
}
add_action( 'admin_init', 'wptuts_options_settings_init' );
 
function wptuts_settings_header_text() {
    ?>
        <p><?php _e( 'Select your photo', 'wptuts' ); ?></p>
    <?php
}
 
function wptuts_setting_logo() {
    $wptuts_options = get_option( 'theme_wptuts_options' );
    // jQuery
wp_enqueue_script('jquery');
// This will enqueue the Media Uploader script
wp_enqueue_media();
?>
    <div>
    <label for="image_url">Img</label>
   

</div>
<script type="text/javascript">
jQuery(document).ready(function($){
    $('#upload-btn').click(function(e) {
        e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Image',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            console.log(uploaded_image);
            var image_url = uploaded_image.toJSON().url;
            // Let's assign the url value to the input field
            $('#image_url').val(image_url);
        });
    });
});
</script>
   
       <img style="max-width:100%;" src="<?php echo esc_url( $wptuts_options['logo'] ); ?>" />
 <input type="text" name="theme_wptuts_options[logo]" value="<?php echo esc_url( $wptuts_options['logo'] ); ?>" id="image_url" class="regular-text">
   
 <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="<?php _e( 'Select logo', 'wptuts' ); ?>" />
        <span class="description"><?php _e('Select your photo .', 'wptuts' ); ?></span>
<br>
<b>En Logo</b>
<br>

    <?php
    
}
function wptuts_setting_logo2() {
    $wptuts_options = get_option( 'theme_wptuts_options' );
    // jQuery
wp_enqueue_script('jquery');
// This will enqueue the Media Uploader script
wp_enqueue_media();
?>
    <div>
    <label for="image_url">Img</label>
   

</div>
<script type="text/javascript">
jQuery(document).ready(function($){
    $('#upload-btn2').click(function(e) {
        e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Image',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            console.log(uploaded_image);
            var image_url2 = uploaded_image.toJSON().url;
            // Let's assign the url value to the input field
            $('#image_url2').val(image_url2);
        });
    });
});
</script>
            <img style="max-width:100%;" src="<?php echo esc_url( $wptuts_options['logo2'] ); ?>" />
 <input type="text" name="theme_wptuts_options[logo2]" value="<?php echo esc_url( $wptuts_options['logo2'] ); ?>" id="image_url2" class="regular-text">
   
 <input type="button" name="upload-btn2" id="upload-btn2" class="button-secondary" value="<?php _e( 'Select logo', 'wptuts' ); ?>" />
        <span class="description"><?php _e('Select your photo.', 'wptuts' ); ?></span>
<br>
<b>Arabic Logo</b>
<br>

    <?php
    
}

function wptuts_options_validate( $input ) {
    $valid_input = $default_options;
 
    $submit = ! empty($input['submit']) ? true : false;
    $reset = ! empty($input['reset']) ? true : false;
 
 if ( $submit ) 
	$valid_input['logo'] = $input['logo'] ;
$valid_input['logo2'] = $input['logo2']; 
if ( $reset )
	$valid_input['logo'] = $default_options['logo']; 

return $valid_input;
}
function logo_html() {
    
    echo '<a href="'.get_site_url().'" ><img src=" ' .$GLOBALS['wptuts_options']['logo'].'" alt="Your Logo" /> </a>';
}
function logo_html_ar(){
    
    echo '<a href="'.get_site_url().'" ><img src=" ' .$GLOBALS['wptuts_options']['logo2'].'" alt="Your Logo" /> </a>';
}
function logo_add (){
     if( ICL_LANGUAGE_CODE == 'en' )
     {  
        return logo_html();
        
    
        }
    else
    {
        return logo_html_ar();    
    }
        
    }

?>
