<?php
/*
Plugin Name: XBOX Live Gamertag
Description: Adds your XBOX Live Gamertag to your sidebar.
Author: Tim Hansen
Version: 1.0
Author URI: http://darkphetus.rayd.org
*/

function widget_xboxgamertag_init() {

	if ( !function_exists('register_sidebar_widget') )
		return;

	function widget_xboxgamertag($args) {
		extract($args);
		$options = get_option('widget_xboxgamertag');
		$title = $options['title'];
		$gamertag = $options['gamertag'];
		echo $before_widget . $before_title . $title . $after_title;
		echo '<br><iframe src="http://gamercard.xbox.com/'.$gamertag.'.card" scrolling="no" frameBorder="0" height="140" width="204">'.$gamertag.'</iframe>';
		echo $after_widget;
	}

	function widget_xboxgamertag_control() {

		$options = get_option('widget_xboxgamertag');
		if ( !is_array($options) )
			$options = array('title'=>'XBOX Gamertag', 'gamertag'=>'trixie360');
		if ( $_POST['xboxgamertag-submit'] ) {
			$options['title'] = strip_tags(stripslashes($_POST['xboxgamertag-title']));
			$options['gamertag'] = strip_tags(stripslashes($_POST['xboxgamertag-gamertag']));
			update_option('widget_xboxgamertag', $options);
		}
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$gamertag = htmlspecialchars($options['gamertag'], ENT_QUOTES);
		echo '<p style="text-align:right;"><label for="xboxgamertag-title">Title: <input style="width: 200px;" id="xboxgamertag-title" name="xboxgamertag-title" type="text" value="'.$title.'" /></label></p>';
		echo '<p style="text-align:right;"><label for="xboxgamertag-gamertag">Gamertag: <input style="width: 200px;" id="xboxgamertag-gamertag" name="xboxgamertag-gamertag" type="text" value="'.$gamertag.'" /></label></p>';
		echo '<input type="hidden" id="xboxgamertag-submit" name="xboxgamertag-submit" value="1" />';
	}

	register_sidebar_widget('XBOX Gamertag', 'widget_xboxgamertag');
	register_widget_control('XBOX Gamertag', 'widget_xboxgamertag_control', 300, 100);

}
add_action('plugins_loaded', 'widget_xboxgamertag_init');

?>