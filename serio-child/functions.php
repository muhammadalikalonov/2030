<?php

add_action( 'wp_enqueue_scripts', 'pearl_child_enqueue_parent_styles' );

function pearl_child_enqueue_parent_styles() {
	wp_enqueue_style( 'child-style', get_stylesheet_uri());
}
