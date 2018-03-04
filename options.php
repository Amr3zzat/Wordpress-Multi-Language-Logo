<?

function multilogo_get_default_options() {
    $options = array(
        'logo' => '',
        'logo2' => '',
    );
    return $options;
}


add_action ( 'admin_enqueue_scripts', function () {
    if (is_admin ())
        wp_enqueue_media ();
} );
?>

<?
function multilogo_options_setup() {
    global $pagenow;
 
    if ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {
        // Now we'll replace the 'Insert into Post Button' inside Thickbox
        add_filter( 'gettext', 'replace_thickbox_text'  , 1, 3 );
    }
}
add_action( 'admin_init', 'multilogo_options_setup' );
 
function replace_thickbox_text($translated_text, $text, $domain) {
    if ('Insert into Post' == $text) {
        $referer = strpos( wp_get_referer(), 'wptuts-settings' );
        if ( $referer != '' ) {
            return __('I want this to be my logo!', 'wptuts' );
        }
    }
    return $translated_text;
}