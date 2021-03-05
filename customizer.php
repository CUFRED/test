<?php

// Customizer
function test_customize_register($wp_customize){
    $wp_customize->add_setting('test_link_color', array(
        'default' => '#007bff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'test_link_color',
            array(
                'label' => 'Цвет ссылок',
                'section' => 'colors',
                'setting' => 'test_link_color',
            )
        )
    );

        // custom section
        $wp_customize->add_section('test_site_data', array(
            'title' => 'Информация сайта',
            'priority' => 10,
        ));
        $wp_customize->add_setting('test_phone', array(
            'default' => '',
            'transport'=>'postMessage',
        ));
        $wp_customize->add_control(
            'test_phone',
            array(
                'label' => 'Телефон',
                'section' => 'test_site_data',
                'type' => 'text',
            )
        );
    
        $wp_customize->add_setting('test_show_phone', array(
            'default' => true,
            'transport'=>'postMessage',
        ));
        $wp_customize->add_control(
            'test_show_phone',
            array(
                'label' => 'Показывать телефон',
                'section' => 'test_site_data',
                'type' => 'checkbox',
            )
        );

}
add_action('customize_register', 'test_customize_register');

function test_customize_css(){
    $test_link_color = get_theme_mod('test_link_color');
    echo <<<HEREDOC
<style type="text/css">
a { color: $test_link_color; }
</style>
HEREDOC;

    /**/?><!--
    <style type="text/css">
        a { color: <?php /*echo get_theme_mod('test_link_color'); */?>; }
    </style>
    --><?php
}
add_action('wp_head', 'test_customize_css');


