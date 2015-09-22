<?php
class TSTemplate {

	/* renders the TCoB App header, takes JS and CSS resources and puts
	them in the header where they should go
	
	use like this:

	$templater = new Template();
	$templater->header( array( 'base.css', 'base.js', 'otherresource.css' ) );
	*/
	static function header( $dependencies = null ) {
		
		/* generate the paths to the applecation resources */
		$css = array();
		$js  = array();
		if ($dependencies !== null) {

			// DO NOT pass user defined paths to this function
			// they can serve themselves whatever file they like if you do
			foreach ($dependencies as $index => $file) {
				if ( preg_match("/\.css$/", $file ) ) {
					$file = APP_RESOURCE_PATH.'css/'.$file; 
					array_push( $css, $file );
				}
				if ( preg_match("/\.js$/", $file )  ) {
					$file = APP_RESOURCE_PATH.'js/'.$file;
					array_push( $js, $file );
				}
			}
		}

		require (__DIR__.'/Templates/Header.php');

	}
	/* use the same as header, but takes no params
	$templater->footer();
	 */
	static function footer() {
		require (__DIR__.'/Templates/Footer.php');
	}
};
?>