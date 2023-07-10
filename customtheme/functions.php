<?php
/**
 * get_template_directory() returns the server path to the theme directory.
 * get_template_directory_uri() returns the URL path to the theme directory.
 * In custom theme development, you would typically use get_template_directory() when including or requiring PHP files or other resources 
 * within your theme, while get_template_directory_uri() is more commonly used for linking to assets like stylesheets, JavaScript files, 
 * images, or other media files.
*/
/**
 * include(): This function includes the specified file and continues executing the script even if the file is not found or encounters an 
 * error during inclusion. If the file is not found, include() generates a warning and allows the script to continue running.
 * require(): This function includes the specified file and stops executing the script if the file is not found or encounters an error during inclusion. 
 * If the file is not found, require() generates a fatal error and terminates the script execution.
*/


// defining theme paths and URI as constants =============================================================
if ( ! defined( 'THEME_DIR_PATH' ) ) {
  define( 'THEME_DIR_PATH', untrailingslashit( get_template_directory() ) );
}

if ( ! defined( 'THEME_DIR_URI' ) ) {
  define( 'THEME_DIR_URI', untrailingslashit( get_template_directory_uri() ) );
}

if ( ! defined( 'THEME_STYLESHEET_URI' ) ) {
  define( 'THEME_STYLESHEET_URI', untrailingslashit( get_stylesheet_uri() ) );
}


// registering our autoloader function =====================================================================
require_once THEME_DIR_PATH . '/inc/helpers/autoloader.php';
spl_autoload_register( '\CUSTOM_THEME\Inc\Helpers\autoloader' );


// =========================================================================================================

function get_theme_instance() {
  \CUSTOM_THEME\Inc\Classes\CUSTOM_THEME::get_instance();
}

function get_scrapper_instance() {
  return \CUSTOM_THEME\Inc\Classes\API_Scrapper::get_instance();
}

get_theme_instance(); // loading the theme class

$scrapper = get_scrapper_instance();
$scrapper->getApiData("api.openbrewerydb.org/breweries/", ['page'=>2, 'per_page'=>3 ]);




