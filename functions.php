<?php
add_action( 'widgets_init', 'tanny_main_sidebar' );
/**
 * Register the main sidebar
 *
 * Because this crappy theme requires dynamically registering sidebars, which is stupid, and the sidebar creation
 * doesn't eve work. Great job. This is a good ol' sidebar that just fucking works.
 *
 * @since 1.0
 * @return void
 */
function tanny_main_sidebar() {
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'ceder' ),
		'id'            => 'main',
		'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'ceder' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'admin_init', 'tanny_remove_unyson_admin_notice' );
/**
 * Remove Unyson admin notice
 *
 * Of course the idiot developer(s) decided to add an admin notice that is not fucking dismissible. I don't want your
 * shitty extensions, just leave me the fuck alone and don't trash my admin screen.
 *
 * @since 1.0
 * @return void
 */
function tanny_remove_unyson_admin_notice() {
	remove_action( 'admin_notices', array( fw()->extensions->manager, '_action_admin_notices' ) );
}