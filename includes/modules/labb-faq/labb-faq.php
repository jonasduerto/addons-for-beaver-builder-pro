<?php

/*
Widget Name: Livemesh FAQ
Description: Capture frequently asked questions in a multi-column grid.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBFAQModule extends FLBuilderModule {

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh FAQ', 'livemesh-bb-addons'),
            'description' => __('Capture frequently asked questions in a multi-column grid.', 'livemesh-bb-addons'),
            'group' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-faq/',
            'url' => LABB_ADDONS_URL . 'labb-faq/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));


        $this->add_js('jquery-waypoints');
        $this->add_css('animate');

    }

}


FLBuilder::register_module('LABBFAQModule', array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'form_section' => array(
                    'title' => __('Frequently Asked Questions', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(
                            'faq_list' => array(
                                'type' => 'form',
                                'label' => __('FAQ Item', 'livemesh-bb-addons'),
                                'form' => 'faq_list_form',
                                'preview_text' => 'question',
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
                    'title' => __('Options', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'per_line' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns per row', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 4,
                                'default' => 2,
                                'description' => 'FAQ per row (max: 4)',
                                'connections' => array('custom_field')
                            ),

                            'per_line_tablet' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns in Tablet Resolution', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 4,
                                'default' => 1,
                                'description' => 'FAQ per row (max: 3)',
                                'connections' => array('custom_field')
                            ),

                            'per_line_mobile' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns in Mobile Resolution', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 3,
                                'default' => 1,
                                'description' => 'FAQ per row (max: 2)',
                                'connections' => array('custom_field')
                            ),
                        )
                ),

            )
        ),

        'style' => array(
            'title' => __('Style', 'livemesh-bb-addons'),
            'sections' => array(
                'title_section' => array(
                    'title' => __('Title', 'livemesh-bb-addons'),
                    'fields' => array(

                        'title_tag' => array(
                            'type' => 'select',
                            'label' => __('Title HTML Tag', 'livemesh-bb-addons'),
                            'default' => 'h3',
                            'options' => array(
                                'h1' => __('H1', 'livemesh-bb-addons'),
                                'h2' => __('H2', 'livemesh-bb-addons'),
                                'h3' => __('H3', 'livemesh-bb-addons'),
                                'h4' => __('H4', 'livemesh-bb-addons'),
                                'h5' => __('H5', 'livemesh-bb-addons'),
                                'h6' => __('H6', 'livemesh-bb-addons'),
                                'div' => __('Div', 'livemesh-bb-addons'),
                            )
                        ),

                        'title_color' => array(
                            'type' => 'color',
                            'label' => __('Title Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
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
            )
        ),
    )
);


/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('faq_list_form', array(
    'title' => __('Frequently Asked Questions', 'livemesh-bb-addons'),
    'tabs' => array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'general' => array(
                    'title' => 'Enter Question & Answer',

                    'fields' => array(
                        'question' => array(
                            'type' => 'text',
                            'label' => __('Question', 'livemesh-bb-addons'),
                            'description' => __('The question for the FAQ item.', 'livemesh-bb-addons'),
                            'connections' => array('string', 'html'),
                        ),

                        'answer' => array(
                            'type' => 'editor',
                            'label' => '',
                            'description' => __('The HTML content as answer for the FAQ item.', 'mo_theme'),
                            'connections' => array('string', 'html'),
                        ),
                    )
                )
            )
        ),
        'settings' => array(
            'title' => __('Settings', 'livemesh-bb-addons'),
            'sections' => array(
                'general' => array(

                    'fields' => array(

                        'faq_animation' => array(
                            'type' => 'select',
                            'label' => __('Choose Animation Type', 'livemesh-bb-addons'),
                            'default' => 'none',
                            'options' => labb_get_animation_options(),
                        ),
                    )
                )
            )
        ),
    )
));
