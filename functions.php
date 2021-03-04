<?php

require_once __DIR__ . '/Test_Menu.php';

/*
 * Подключение скриптов и стилей
 */
function test_scripts(){
    wp_enqueue_style('test-bootstrapcss', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
    wp_enqueue_style('test-style', get_stylesheet_uri());

    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), false, true);
    //wp_enqueue_script( 'jquery' );
    wp_enqueue_script('test-popper', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array('jquery'), false, true);
    wp_enqueue_script('test-bootstrapjs', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), false, true);
}
add_action('wp_enqueue_scripts', 'test_scripts');


/*add_theme_support( 'custom-logo', [
	'height'      => 290,
	'width'       => 290,
	'flex-width'  => false,
	'flex-height' => false,
	'header-text' => '',
	'unlink-homepage-logo' => false, // WP 5.5
] );*/


function test_setup(){
    add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-background', array (
		'default-color'          => '#eeeeee',
		'default-image'          => get_stylesheet_directory_uri() . '/assets/img/image.jpg',
		'default-repeat'         => 'no-repeat',
		'default-position-x'     => 'center',
		'default-attachment'	 => 'fixed'
	 ) );

	 add_theme_support( 'custom-header', array (
		'default-color'          => '#eeeeee',
		'default-image'          => get_stylesheet_directory_uri() . '/assets/img/img.jpg',
		'height'      => 2000,
		'width'       => 1300,
	 ) );
	
	add_theme_support( 'custom-logo', array (
		'height'      => 150,
		'width'       => 40,
		'flex-width'  => true,
		'flex-height' => true,
	) );
	
	
	
	register_nav_menus( array (
		'header_menu 1' => 'Меню в шапке 1',
		'footer_menu 2' => 'Меню в подвале 2',
	) );
    //add_image_size( 'my-thumb', 100, 100 );
}
add_action( 'after_setup_theme', 'test_setup' );


add_action( 'widgets_init', 'register_my_widgets' );
function register_my_widgets(){

	register_sidebar( array(
		'name'          => 'Сайдбар с права',
		'id'            => "right-sidebar",
		'description'   => 'Сайдбар в боковой панели для вывода информации',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => "</div>\n",
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => "</h4>\n",
	) );
}


// удаляет H2 из шаблона пагинации
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){

	return '
	<nav class="navigation" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>    
	';
}

// выводим пагинацию
the_posts_pagination( array(
	'end_size' => 2,
) ); 