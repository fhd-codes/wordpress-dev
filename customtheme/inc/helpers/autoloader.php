<?php
/**
 * Autoloader file for theme. 
 * 
 * In order to make it work, our namespaces should follow the directory structure.
 * This autoloader function is reading the namespaces, and converting those namespaces to the filepath 
 * Once the file path is obtained from the namespaces, it is validated if it exists or not.
 * If it does, we are using require_once() function to use that file.
 
 * Once the autoloader function has been written we have to register it using spl_autoload_register() funciton
 * When a class is initiated, and not included above, wordpress looks for the autoloader functions that are registered using spl_autoload_register()
 * From that, it converts your namespace to the filepath and add that class/ function
 * 
 * NOTE: you can have multiple autoloader functions for your project.
 * 
 * Under the hood, the classes and functions are loaded through the file path using the autoloader function. 
 * The benefit of using this is that we do not need to include the file path manually everytime when the class/ function is called.
*/


// this autoloader is registered in the function.php file


 namespace CUSTOM_THEME\Inc\Helpers;

/**
 * Auto loader function.
 *
 * @param string $resource Source namespace.
 *
 * @return void
*/

function autoloader( $resource = '' ) {
	$resource_path  = false;
	$namespace_root = 'CUSTOM_THEME\\';
	$resource       = trim( $resource, '\\' );

	if ( empty( $resource ) || strpos( $resource, '\\' ) === false || strpos( $resource, $namespace_root ) !== 0 ) {
		// Not our namespace, bail out.
		return;
	}

	// Remove our root namespace.
	$resource = str_replace( $namespace_root, '', $resource );

	$path = explode(
		'\\',
		str_replace( '_', '-', strtolower( $resource ) )
	);

	/**
	 * Time to determine which type of resource path it is,
	 * so that we can deduce the correct file path for it.
    */
	if ( empty( $path[0] ) || empty( $path[1] ) ) {
		return;
	}

	$directory = '';
	$file_name = '';

	if ( 'inc' === $path[0] ) {

		switch ( $path[1] ) {
			case 'traits':
				$directory = 'traits';
				$file_name = sprintf( 'trait-%s', trim( strtolower( $path[2] ) ) );
				break;

			case 'widgets':

			case 'blocks': // phpcs:ignore PSR2.ControlStructures.SwitchDeclaration.TerminatingComment
				/**
				 * If there is class name provided for specific directory then load that.
				 * otherwise find in inc/ directory.
				 */
				if ( ! empty( $path[2] ) ) {
					$directory = sprintf( 'classes/%s', $path[1] );
					$file_name = sprintf( 'class-%s', trim( strtolower( $path[2] ) ) );
					break;
				}

			case 'classes':
				$directory = 'classes';
				
				if (!empty($path[2]) && $path[2] == "scrappers"){
					$directory = sprintf( 'classes/%s', $path[2] );
					$file_name = sprintf( 'scrapper-%s', trim( strtolower( $path[3] ) ) );
					break;
				}

				$file_name = sprintf( 'class-%s', trim( strtolower( $path[2] ) ) );
				break;

            default:
                wp_die("error in autoloader. No filepath found");
		}

		$resource_path = sprintf( '%s/inc/%s/%s.php', untrailingslashit( THEME_DIR_PATH ), $directory, $file_name );

	}

	/**
	 * If $is_valid_file has 0 means valid path or 2 means the file path contains a Windows drive path.
    */
	$is_valid_file = validate_file( $resource_path );

	if ( ! empty( $resource_path ) && file_exists( $resource_path ) && ( 0 === $is_valid_file || 2 === $is_valid_file ) ) {
		// We already making sure that file is exists and valid.
		require_once( $resource_path ); // phpcs:ignore
	}

}

