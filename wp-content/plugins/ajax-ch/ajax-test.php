<?php
/**
 * Plugin Name: Ajax ch
 * Plugin URI: http://www.valakax.com
 * Description: Ajax by me
 * Version: 1.0.0
 * Author: Christian Juhal
 * Author URI: http://www.valakax.com
 * License: GPL2
 */


 add_action( 'wp_enqueue_scripts', 'ajax_test_enqueue_scripts' );
 function ajax_test_enqueue_scripts() {
 	wp_enqueue_script( 'test', plugins_url( '/test.js', __FILE__ ), array('jquery'), '1.0', true );
 }

 add_action( 'wp_enqueue_scripts', 'post_love_assets' );
 function post_love_assets() {
 	if( is_single() ) {
 		wp_enqueue_style( 'love', plugins_url( '/love.css', __FILE__ ) );
 	}

 ?>
