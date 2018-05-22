<?php

/*
Widget Name: Livemesh Icon List
Description: Use images or icon fonts to create social icons list, show payment options etc.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBIconListModule extends FLBuilderModule {

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Icon List', 'livemesh-bb-addons'),
            'description' => __('Use images or icon fonts to create social icons list, show payment options etc.', 'livemesh-bb-addons'),
            'group' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-icon-list/',
            'url' => LABB_ADDONS_URL . 'labb-icon-list/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));


        $this->add_js('jquery-waypoints');
        $this->add_js('jquery-powertip');
        $this->add_css('animate');

    }


}

FLBuilder::register_module('LABBIconListModule', array(
        'general' => array(
            'title' => __('Add Icons', 'livemesh-bb-addons'),
            'sections' => array(
                'form_section' => array(
                    'title' => __('Icon List', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'icon_list' => array(
                                'type' => 'form',
                                'label' => __('Icon', 'livemesh-bb-addons'),
                                'form' => 'icon_list_form',
                                'preview_text' => 'icon_title',
                                'multiple' => true
                            ),
                        )
                )
            )
        ),
        'options' => array(
            'title' => __('Options', 'livemesh-bb-addons'),
            'sections' => array(
                'options_section' => array(
                    'fields' =>
                        array(


                            "new_window" => array(
                                "type" => 'labb-toggle-button',
                                "label" => __("Open the links in new window", "livemesh-bb-addons"),
                                'default' => 'yes'
                            ),

                            'align' => array(
                                'type' => 'select',
                                'label' => __('Alignment', 'livemesh-bb-addons'),
                                'default' => 'left',
                                'options' => array(
                                    'left' => __('Left', 'livemesh-bb-addons'),
                                    'right' => __('Right', 'livemesh-bb-addons'),
                                    'center' => __('Center', 'livemesh-bb-addons'),
                                )
                            ),

                            'icon_animation' => array(
                                'type' => 'select',
                                'label' => __('Choose Animation Type', 'livemesh-bb-addons'),
                                'default' => 'none',
                                'options' => labb_get_animation_options(),
                            ),
                        )
                ),
            )
        ),


        'style' => array(
            'title' => __('Style', 'livemesh-bb-addons'),
            'sections' => array(
                'icon_section' => array(
                    'title' => __('Icons', 'livemesh-bb-addons'),
                    'fields' => array(

                        'icon_color' => array(
                            'type' => 'color',
                            'label' => __('Icon Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'hover_color' => array(
                            'type' => 'color',
                            'label' => __('Icon Hover Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),

                        'icon_size' => array(
                            'type' => 'labb-number',
                            'label' => __('Icon Size', 'livemesh-bb-addons'),
                            'description' => 'px',
                            'min' => 1,
                            'max' => 128,
                            'default' => 32
                        ),
                        'icon_spacing' => array(
                            'type' => 'labb-number',
                            'label' => __('Spacing between icons', 'livemesh-bb-addons'),
                            'description' => 'px',
                            'min' => 1,
                            'max' => 100,
                            'default' => 15
                        ),
                    )
                ),
                'tooltip_section' => array(
                    'title' => __('Tooltip', 'livemesh-bb-addons'),
                    'description' => __('Changing these values for one icon list affects all other instances in the page.', 'livemesh-bb-addons'),
                    'fields' => array(
                        
                        'tooltip_color' => array(
                            'type' => 'color',
                            'label' => __('Tooltip Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'tooltip_bg_color' => array(
                            'type' => 'color',
                            'label' => __('Tooltip Background Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'tooltip_padding' => array(
                            'type' => 'labb-number',
                            'label' => __('Tooltip Padding', 'livemesh-bb-addons'),
                            'description' => 'px',
                            'default' => 10

                        ),
                        'tooltip_font' => array(
                            'type' => 'font',
                            'label' => __('Tooltip font', 'livemesh-bb-addons'),
                            'default' => array(
                                'family' => 'Default',
                                'weight' => 'default'
                            ),
                        ),
                        'tooltip_font_size' => array(
                            'type' => 'unit',
                            'label' => __('Tooltip Font Size', 'livemesh-bb-addons'),
                            'responsive' => true,
                            'description' => 'px'
                        ),
                        'tooltip_line_height' => array(
                            'type' => 'unit',
                            'label' => __('Tooltip Line height', 'livemesh-bb-addons'),
                            'responsive' => true,
                            'description' => 'px'
                        ),
                    )
                ),
            )
        ),
    )
);


/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('icon_list_form', array(
    'title' => __('Icon', 'livemesh-bb-addons'),
    'tabs' => array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'general' => array(
                    'title' => 'Enter Icon Info',

                    'fields' => array(
                        'icon_title' => array(
                            'type' => 'text',
                            'label' => __('Title', 'livemesh-bb-addons'),
                            'description' => __('Title for the Icon.', 'livemesh-bb-addons'),
                            'connections' => array('string', 'html'),
                        ),

                        'icon_type' => array(
                            'type' => 'select',
                            'label' => __('Choose Icon Type', 'livemesh-bb-addons'),
                            'default' => 'icon',
                            'toggle' => array(
                                'icon_image' => array(
                                    'fields' => array('icon_image')
                                ),
                                'icon' => array(
                                    'fields' => array('font_icon'),
                                ),
                            ),
                            'options' => array(
                                'icon' => __('Icon', 'livemesh-bb-addons'),
                                'icon_image' => __('Icon Image', 'livemesh-bb-addons'),
                            ),
                            'connections' => array('custom_field')
                        ),

                        'icon_image' => array(
                            'type' => 'photo',
                            'label' => __('Icon Image.', 'livemesh-bb-addons'),
                            'connections' => array('photo')
                        ),

                        'font_icon' => array(
                            'type' => 'icon',
                            'label' => __('Icon.', 'livemesh-bb-addons'),
                        ),

                        'icon_link' => array(
                            'type' => 'link',
                            'label' => __('Target URL', 'livemesh-bb-addons'),
                            'description' => __('The URL to which icon/image should point to. (optional)', 'livemesh-bb-addons'),
                            'connections' => array('url'),
                        ),

                    )
                )
            )
        ),
    )
));
