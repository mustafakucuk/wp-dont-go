<?php

## Don't GO Admin Assets ##
function dontgoAdminAssets() {
	wp_enqueue_style( 'dontgo', dontgo.'/assets/css/wpajansPanel.css' );
	wp_enqueue_script( 'wpajansPlugin', dontgo.'/assets/js/wpajansPlugin.js' );
}
add_action( 'admin_enqueue_scripts', 'dontgoAdminAssets' );

## Don't GO Create Admin Menu ##
function dontgo_admin_menu() {
	if( @!$GLOBALS['admin_page_hooks']['wpajans'] ){
		add_menu_page( 'WPAJANS', 'WPAJANS', '', 'wpajans', 'wpajans', dontgo.'/assets/img/wpajans.png');
	}
	add_submenu_page( 'wpajans', "WP Don't GO Settings", "WP Don't GO", "manage_options", "dontgoSettings", "dontgoSettings", dontgo."/assets/img/icon.png");
}
add_action( 'admin_menu', 'dontgo_admin_menu' );

## Don't GO Default Settings ##
register_activation_hook(dontgoPath, 'dontgoDefaultSettings');
	function dontgoDefaultSettings() {
		add_option('dontgoTitle', 'Come Back!');
		add_option('dontgoDelay', '1000');
		add_option('dontgoFavicon', dontgo.'/assets/img/icon.png');
		$secretAlg = wordwrap(strtoupper(md5(str_replace("www.", "", getenv("HTTP_HOST")))),4,'-',true);
		$domain = str_replace("www.", "", getenv("HTTP_HOST"));
		$apiURL = 'https://api.wpajans.net/v1/?action=siteAdd&secret='.$secretAlg.'&domain='.$domain.'&type=plugin&product=dontgo&licence=wp';
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$apiURL);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		$output=curl_exec($ch);
		curl_close($ch);		
	}

## Don't GO Settings Page ##
function dontgoSettings() {
	if( $_POST and $_POST["dontgoUpdate"] == "update" ) {
		if ( !isset( $_POST['wpajans_dontgo_update'] ) || !wp_verify_nonce( $_POST['wpajans_dontgo_update'], 'wpajans_dontgo_update' ) ) {
			echo '<div class="wpajansNotice">Error! Please try again.</div>';
		}else{
			$dontgoTitle   = sanitize_text_field( $_POST["dontgoTitle"] );
			$dontgoDelay   = sanitize_text_field( $_POST["dontgoDelay"] );
			$dontgoFavicon = sanitize_text_field( $_POST["dontgoFavicon"] );
			update_option( 'dontgoTitle', $dontgoTitle );
			update_option( 'dontgoDelay', $dontgoDelay );
			update_option( 'dontgoFavicon', $dontgoFavicon );
			echo '<div class="wpajansNotice">Settings Saved!</div>';
		}
	}
	?>
	<div class="wrap wrapLeft">
	<div id="wpnlh_navbar"><span> WP Don't GO <small><?php echo dontgoVersion; ?></small></span></div>
	<div id="wpnlh_content">
		<div id="wpnlh_content_block">
			<form method="post">
				<label for="title">Title: </label>
				<input type="text" class="wpajansInput" id="title" placeholder="Title" name="dontgoTitle" value="<?php echo get_option('dontgoTitle'); ?>"/>
				<br>
				<label for="delay">Delay: </label>
				<input type="text" class="wpajansInput" id="delay" placeholder="Delay" name="dontgoDelay" value="<?php echo get_option('dontgoDelay'); ?>"/>
				<br>
				<label for="faviconURI">Favicon URI: </label>
				<input type="text" class="wpajansInput" id="faviconURI" placeholder="Favicon URI" name="dontgoFavicon" value="<?php echo get_option('dontgoFavicon'); ?>"/>
				<br>
				<?php wp_nonce_field( 'wpajans_dontgo_update', 'wpajans_dontgo_update' ); ?>
				<input type="hidden" name="dontgoUpdate" value="update"/>
				<input type="submit" id="submit" name="submit" class="button-primary" value="<?php _e('Save Changes'); ?>" />
			</form>
		</div>
	</div>
	</div>
	<div class="wrap wrapRight">
	<div id="wpnlh_navbar"><span> WP Don't GO <small><?php echo dontgoVersion; ?></small></span></div>
	<div id="wpnlh_content">
		<div id="wpnlh_content_block">
			<a href="https://wpajans.net"><img src="<?php echo dontgo;?>/assets/img/wpajansLogo.png" class="wpajansLogo"></a>
			For your plugin and theme needs: <a href="mailto:info@wpajans.net">info@wpajans.net</a>
			<br>
			<hr>
			<div class="title">Links</div>
			<a href="https://musteri.wpajans.net" target="_blank">Customer Panel</a>
			<br>
			<a href="<?php echo dontgoSR; ?>/reviews/#new-post" target="_blank">Add Review</a>
			<br>
			<a href="<?php echo dontgoSR; ?>/" target="_blank">Support</a>
			<hr>
			<!-- Plugin CODES -->
			<div class="title">Preview</div>
			<hr>
			<div class="box">
				<div class="corner"><img src=""> <span><?php bloginfo('title'); ?></span></div>
			</div>
			<!-- #Plugin CODES -->
		</div>
	</div>
	</div>
	<?php
}