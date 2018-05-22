<?php

/*
Widget Name: Livemesh Tabs
Description: Display tabbed content in variety of styles.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBTabsModule extends FLBuilderModule {


    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Tabs', 'livemesh-bb-addons'),
            'description' => __('Display tabbed content in variety of styles.', 'livemesh-bb-addons'),
            'group' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-tabs/',
            'url' => LABB_ADDONS_URL . 'labb-tabs/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));

    }

    function get_theme_color() {

        return labb_get_theme_color();

    }

}


FLBuilder::register_module('LABBTabsModule', array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'options_section' => array(
                    'fields' =>
                        array(

                            'style' => array(
                                'type' => 'select',
                                'label' => __('Choose Tab Style', 'livemesh-bb-addons'),
                                'state_emitter' => array(
                                    'callback' => 'select',
                                    'args' => array('style')
                                ),
                                'default' => 'style1',
                                'options' => array(
                                    'style1' => __('Tab Style 1', 'livemesh-bb-addons'),
                                    'style2' => __('Tab Style 2', 'livemesh-bb-addons'),
                                    'style3' => __('Tab Style 3', 'livemesh-bb-addons'),
                                    'style4' => __('Tab Style 4', 'livemesh-bb-addons'),
                                    'style5' => __('Tab Style 5', 'livemesh-bb-addons'),
                                    'style6' => __('Tab Style 6', 'livemesh-bb-addons'),
                                    'style7' => __('Vertical Tab Style 1', 'livemesh-bb-addons'),
                                    'style8' => __('Vertical Tab Style 2', 'livemesh-bb-addons'),
                                    'style9' => __('Vertical Tab Style 3', 'livemesh-bb-addons'),
                                    'style10' => __('Vertical Tab Style 4', 'livemesh-bb-addons'),
                                ),
                                'connections' => array('custom_field')
                            ),

                            'mobile_width' => array(
                                'type' => 'text',
                                'label' => __('Mobile Resolution', 'livemesh-bb-addons'),
                                'description' => __('The px resolution to treat as a mobile resolution for invoking responsive tabs.', 'livemesh-bb-addons'),
                                'default' => '767',
                                'maxlength' => '4',
                                'size' => '5',
                                'connections' => array('custom_field')
                            ),
                        )
                ),

                'form_section' => array(
                    'title' => __('Tab Panes', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'tabs' => array(
                                'type' => 'form',
                                'label' => __('Tab Pane', 'livemesh-bb-addons'),
                                'form' => 'tabs_form',
                                'preview_text' => 'tab_title',
                                'multiple' => true
                            ),
                        )
                )
            )
        ),


        'style' => array(
            'title' => __('Style', 'livemesh-bb-addons'),
            'sections' => array(
                'title_section' => array(
                    'title' => __('Tab Title', 'livemesh-bb-addons'),
                    'fields' => array(

                        'title_color' => array(
                            'type' => 'color',
                            'label' => __('Tab Title Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'title_active_color' => array(
                            'type' => 'color',
                            'label' => __('Active Tab Title Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'title_hover_color' => array(
                            'type' => 'color',
                            'label' => __('Tab Hover Title Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'highlight_color' => array(
                            'type' => 'color',
                            'label' => __('Tab highlight Border color', 'livemesh-bb-addons'),
                            'state_handler' => array(
                                'style[style4,style6,style7,style8]' => array('show'),
                                '_else[style]' => array('hide'),
                            ),
                            'default' => '#f94213',
                        ),

                        'title_top_bottom_padding' => array(
                            'type' => 'labb-number',
                            'label' => __('Tab Title Top and Bottom Padding', 'livemesh-bb-addons'),
                            'description' => 'px'

                        ),
                        'title_left_right_padding' => array(
                            'type' => 'labb-number',
                            'label' => __('Tab Title Left and Right Padding', 'livemesh-bb-addons'),
                            'description' => 'px'

                        ),

                        'title_font' => array(
                            'type' => 'font',
                            'label' => __('Title font', 'livemesh-bb-addons'),
                            'default' => array(
                                'family' => 'Default',
                                'weight' => 'default'
                            ),
                        ),
                        'title_font_size' => array(
                            'type' => 'unit',
                            'label' => __('Title Font Size', 'livemesh-bb-addons'),
                            'responsive' => true,
                            'description' => 'px'
                        ),
                        'title_line_height' => array(
                            'type' => 'unit',
                            'label' => __('Title Line height', 'livemesh-bb-addons'),
                            'responsive' => true,
                            'description' => 'px'
                        ),
                        'title_text_transform' => array(
                            'type' => 'select',
                            'label' => __('Text Transform', 'livemesh-bb-addons'),
                            'default' => 'none',
                            'options' => array(
                                'none' => __('Default', 'livemesh-bb-addons'),
                                'capitalize' => __('Capitalize', 'livemesh-bb-addons'),
                                'uppercase' => __('Uppercase', 'livemesh-bb-addons'),
                                'lowercase' => __('Lowercase', 'livemesh-bb-addons'),
                                'initial' => __('Initial', 'livemesh-bb-addons'),
                                'inherit' => __('Inherit', 'livemesh-bb-addons'),
                            ),
                        ),
                    )
                ),
                'content_section' => array(
                    'title' => __('Content', 'livemesh-bb-addons'),
                    'fields' => array(


                        'content_top_bottom_padding' => array(
                            'type' => 'labb-number',
                            'label' => __('Tab Content Top and Bottom Padding', 'livemesh-bb-addons'),
                            'description' => 'px'

                        ),
                        'content_left_right_padding' => array(
                            'type' => 'labb-number',
                            'label' => __('Tab Content Left and Right Padding', 'livemesh-bb-addons'),
                            'description' => 'px'

                        ),

                        'content_color' => array(
                            'type' => 'color',
                            'label' => __('Text Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'content_font' => array(
                            'type' => 'font',
                            'label' => __('Text font', 'livemesh-bb-addons'),
                            'default' => array(
                                'family' => 'Default',
                                'weight' => 'default'
                            ),
                        ),
                        'content_font_size' => array(
                            'type' => 'unit',
                            'label' => __('Text Font Size', 'livemesh-bb-addons'),
                            'responsive' => true,
                            'description' => 'px'
                        ),
                        'content_line_height' => array(
                            'type' => 'unit',
                            'label' => __('Text Line height', 'livemesh-bb-addons'),
                            'responsive' => true,
                            'description' => 'px'
                        ),
                    )
                ),
                'icon_section' => array(
                    'title' => __('Icons', 'livemesh-bb-addons'),
                    'fields' => array(
                        'icon_size' => array(
                            'type' => 'labb-number',
                            'label' => __('Icon or Icon Image size in pixels', 'livemesh-bb-addons'),
                            'description' => 'px',
                            'min' => 10,
                            'max' => 256,
                        ),
                        'icon_color' => array(
                            'type' => 'color',
                            'label' => __('Icon Color', 'livemesh-bb-addons'),
                            'show_reset' => true,
                        ),
                        'active_icon_color' => array(
                            'type' => 'color',
                            'label' => __('Active Tab Icon Color', 'livemesh-bb-addons'),
                            'show_reset' => true,
                        ),
                        'hover_icon_color' => array(
                            'type' => 'color',
                            'label' => __('Tab Hover Icon Color', 'livemesh-bb-addons'),
                            'show_reset' => true,
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
FLBuilder::register_settings_form('tabs_form', array(
    'title' => __('Tab Pane', 'livemesh-bb-addons'),
    'tabs' => array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'general' => array(
                    'title' => 'Enter Tab Content',

                    'fields' => array(
                        'tab_title' => array(
                            'type' => 'text',
                            'label' => __('Tab Title', 'livemesh-bb-addons'),
                            'description' => __('The title for the tab shown as name for tab navigation.', 'livemesh-bb-addons'),
                            'connections' => array('string', 'html'),
                        ),

                        'tab_id' => array(
                            'type' => 'text',
                            'label' => __('Tab ID', 'livemesh-bb-addons'),
                            'description' => __('The Tab ID is required to link to a tab. It must be unique across the page, must begin with a letter and may be followed by any number of letters, digits, hyphens or underscores.', 'livemesh-bb-addons'),
                            'connections' => array('string', 'html'),
                        ),

                        'tab_content' => array(
                            'type' => 'editor',
                            'label' => '',
                            'description' => __('The content of the tab.', 'livemesh-bb-addons'),
                            'connections' => array('string', 'html'),
                        ),

                    )
                )
            )
        ),
        'tab_icons' => array(
            'title' => __('Tab Icon', 'livemesh-bb-addons'),
            'sections' => array(
                'general' => array(
                    'title' => 'Enter Icon Information',

                    'fields' => array(
                        'icon_type' => array(
                            'type' => 'select',
                            'label' => __('Choose Icon Type', 'livemesh-bb-addons'),
                            'default' => 'none',
                            'toggle' => array(
                                'icon_image' => array(
                                    'fields' => array('icon_image')
                                ),
                                'icon' => array(
                                    'fields' => array('font_icon'),
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
                            'label' => __('Tab Image.', 'livemesh-bb-addons'),
                            'connections' => array('photo')
                        ),

                        'font_icon' => array(
                            'type' => 'icon',
                            'label' => __('Tab Icon.', 'livemesh-bb-addons'),
                        ),
                    )
                )
            )
        ),
    )
));