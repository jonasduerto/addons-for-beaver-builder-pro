<?php

/*
Widget Name: Livemesh Button
Description: Flat style buttons with rich set of customization options.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBButtonModule extends FLBuilderModule {

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Button', 'livemesh-bb-addons'),
            'description' => __("Flat style buttons with rich set of customization options.", "livemesh-bb-addons"),
            'group' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-button/',
            'url' => LABB_ADDONS_URL . 'labb-button/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));


        $this->add_js('jquery-waypoints');
        $this->add_css('animate');

    }

}

FLBuilder::register_module('LABBButtonModule', array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'options_section' => array(
                    'title' => __('Options', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(
                            "button_href" => array(
                                "type" => "link",
                                "description" => __("The URL to which button should point to.", "livemesh-bb-addons"),
                                "label" => __("Target URL", "livemesh-bb-addons"),
                                "default" => __("http://targeturl.com", "livemesh-bb-addons"),
                                'connections' => array('url'),
                            ),
                            "button_target" => array(
                                "type" => 'labb-toggle-button',
                                "label" => __("Open the link in new window", "livemesh-bb-addons"),
                                "default" => 'yes',
                            ),
                            "button_title" => array(
                                "type" => "text",
                                "description" => __("The button title or text. ", "livemesh-bb-addons"),
                                "label" => __("Button Title", "livemesh-bb-addons"),
                                "default" => __("Buy Now", "livemesh-bb-addons"),
                                'connections' => array('string', 'html'),
                            ),
                        )
                ),
                'icons_section' => array(
                    'title' => __('Button Icon/Image', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'icon_type' => array(
                                'type' => 'select',
                                'label' => __('Choose Icon Type', 'livemesh-bb-addons'),
                                'default' => 'none',
                                'toggle' => array(
                                    'icon_image' => array(
                                        'sections'  => array( 'button_icon_section' ),
                                        'fields' => array('icon_image')
                                    ),
                                    'icon' => array(
                                        'sections'  => array( 'button_icon_section' ),
                                        'fields' => array('font_icon', 'icon_color', 'icon_hover_color'),
                                    ),
                                ),
                                'options' => array(
                                    'none' => __('None', 'livemesh-bb-addons'),
                                    'icon' => __('Icon', 'livemesh-bb-addons'),
                                    'icon_image' => __('Icon Image', 'livemesh-bb-addons'),
                                ),
                                'connections' => array('custom_field')
                            ),

                            'icon_image' => array(
                                'type' => 'photo',
                                'label' => __('Button Image.', 'livemesh-bb-addons'),
                                'connections' => array('photo'),
                            ),

                            'font_icon' => array(
                                'type' => 'icon',
                                'label' => __('Button Icon.', 'livemesh-bb-addons'),
                            ),
                        )
                )
            )
        ),
        'settings' => array(
            'title' => __('Settings', 'livemesh-bb-addons'),
            'sections' => array(
                'general_section' => array(
                    'fields' =>
                        array(

                            "button_class" => array(
                                "type" => "text",
                                "description" => __("The CSS class name for the button element.", "livemesh-bb-addons"),
                                "label" => __("Class", "livemesh-bb-addons"),
                                "default" => "",
                                "optional" => "true"
                            ),
                            "button_style" => array(
                                "type" => "text",
                                "description" => __("Inline CSS styling for the button element.", "livemesh-bb-addons"),
                                "label" => __("Style", "livemesh-bb-addons"),
                                "optional" => "true"
                            ),

                            "button_align" => array(
                                "type" => "select",
                                "description" => __("Alignment of the button displayed.", "livemesh-bb-addons"),
                                "label" => __("Align", "livemesh-bb-addons"),
                                "options" => array(
                                    "none" => __("None", "livemesh-bb-addons"),
                                    "center" => __("Center", "livemesh-bb-addons"),
                                    "left" => __("Left", "livemesh-bb-addons"),
                                    "right" => __("Right", "livemesh-bb-addons"),
                                ),
                                'default' => 'none'
                            ),

                            'button_animation' => array(
                                'type' => 'select',
                                'label' => __('Choose Animation Type', 'livemesh-bb-addons'),
                                'default' => 'none',
                                'options' => labb_get_animation_options(),
                            ),

                        )
                ),
            )
        ),
        'customize' => array(
            'title' => __('Customize', 'livemesh-bb-addons'),
            'sections' => array(
                'customize_section' => array(
                    'title' => __('Customize Button', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(
                            "button_color" => array(
                                "type" => "select",
                                "label" => __("Button Color", "livemesh-bb-addons"),
                                "description" => __("Can be overridden with custom colors in Style tab.", "livemesh-bb-addons"),
                                "options" => array(
                                    "default" => __("Default", "livemesh-bb-addons"),
                                    "black" => __("Black", "livemesh-bb-addons"),
                                    "blue" => __("Blue", "livemesh-bb-addons"),
                                    "cyan" => __("Cyan", "livemesh-bb-addons"),
                                    "green" => __("Green", "livemesh-bb-addons"),
                                    "orange" => __("Orange", "livemesh-bb-addons"),
                                    "pink" => __("Pink", "livemesh-bb-addons"),
                                    "red" => __("Red", "livemesh-bb-addons"),
                                    "teal" => __("Teal", "livemesh-bb-addons"),
                                    "trans" => __("Transparent", "livemesh-bb-addons"),
                                    "semitrans" => __("Semi Transparent", "livemesh-bb-addons"),
                                ),
                                'state_emitter' => array(
                                    'callback' => 'select',
                                    'args' => array('color')
                                ),
                            ),
                            "button_type" => array(
                                "type" => "select",
                                "label" => __("Button Size", "livemesh-bb-addons"),
                                "description" => __("Can be overridden with custom padding in Style tab.", "livemesh-bb-addons"),
                                "options" => array(
                                    "medium" => __("Medium", "livemesh-bb-addons"),
                                    "large" => __("Large", "livemesh-bb-addons"),
                                    "small" => __("Small", "livemesh-bb-addons"),
                                )
                            ),
                            'rounded' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Display rounded button?', 'livemesh-bb-addons'),
                                "description" => __("Can be overridden with custom border radius in Style tab.", "livemesh-bb-addons"),
                                'default' => 'no'
                            ),
                        )
                ),
            )
        ),
        
        'style' => array(
            'title' => __('Style', 'livemesh-bb-addons'),
            'sections' => array(

                'button_section' => array(
                    'title' => __('General', 'livemesh-bb-addons'),
                    'fields' => array(

                        'button_custom_color' => array(
                            'type' => 'color',
                            'label' => __('Button Custom Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'button_custom_hover_color' => array(
                            'type' => 'color',
                            'label' => __('Button Custom Hover Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'button_top_bottom_padding' => array(
                            'type' => 'labb-number',
                            'label' => __('Button Top and Bottom Padding', 'livemesh-bb-addons'),
                            'description' => 'px'

                        ),
                        'button_left_right_padding' => array(
                            'type' => 'labb-number',
                            'label' => __('Button Left and Right Padding', 'livemesh-bb-addons'),
                            'description' => 'px'

                        ),
                        'button_border_radius' => array(
                            'type' => 'labb-number',
                            'label' => __('Custom Border Radius', 'livemesh-bb-addons'),
                            'description' => 'px'

                        ),
                    )
                ),

                'button_label_section' => array(
                    'title' => __('Button Label', 'livemesh-bb-addons'),
                    'fields' => array(

                        'button_label_color' => array(
                            'type' => 'color',
                            'label' => __('Button Label Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'button_label_font' => array(
                            'type' => 'font',
                            'label' => __('Button Label font', 'livemesh-bb-addons'),
                            'default' => array(
                                'family' => 'Default',
                                'weight' => 'default'
                            ),
                        ),
                        'button_label_font_size' => array(
                            'type' => 'unit',
                            'label' => __('Button Label Font Size', 'livemesh-bb-addons'),
                            'responsive' => true,
                            'description' => 'px'
                        ),
                        'button_label_line_height' => array(
                            'type' => 'unit',
                            'label' => __('Button Label Line height', 'livemesh-bb-addons'),
                            'responsive' => true,
                            'description' => 'px'
                        ),
                    )
                ),


                'button_icon_section' => array(
                    'title' => __('Button Icon', 'livemesh-bb-addons'),
                    'fields' => array(
                        'icon_size' => array(
                            'type' => 'labb-number',
                            'label' => __('Icon or Icon Image size in pixels', 'livemesh-bb-addons'),
                            'description' => 'px',
                            'min' => 6,
                            'max' => 128,
                            'default' => 24
                        ),
                        'icon_spacing' => array(
                            'type' => 'labb-number',
                            'label' => __('Space between icon/image and label.', 'livemesh-bb-addons'),
                            'description' => 'px',
                            'min' => 1,
                            'max' => 64,
                            'default' => 15
                        ),
                        'icon_color' => array(
                            'type' => 'color',
                            'label' => __('Icon Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'icon_hover_color' => array(
                            'type' => 'color',
                            'label' => __('Icon Hover Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                    )
                ),
            )
        ),
        
        
    )
);