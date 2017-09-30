<?php

function dontgoFront() {
	wp_enqueue_script( 'dontgo', dontgo.'/assets/js/dontgo.js' );
echo '<script>var dontgoSettings = {"dontgoTitle":"'.get_option("dontgoTitle").'", "dontgoDelay": "'.get_option("dontgoDelay").'", "dontgoFavicon": "'.get_option("dontgoFavicon").'"};</script>';
}
add_action( 'wp_footer', 'dontgoFront' );
