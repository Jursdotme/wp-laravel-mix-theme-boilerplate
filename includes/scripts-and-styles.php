<?php


// use WPLMixTheme\AssetResolver;


add_action('wp_enqueue_scripts', function () {

	// registers scripts and stylesheets
	wp_register_style('app', get_template_directory_uri() . '/public/css/app.css', [], false);
	wp_register_script('app', get_template_directory_uri() . '/public/js/app.js', [], false, true);
	wp_register_script('vue', 'https://unpkg.com/vue@3', [], false, true);


	// enqueue global assets
	wp_enqueue_script('vue');
	wp_enqueue_script('jquery');
	wp_enqueue_style('app');
	wp_enqueue_script('app');
});
