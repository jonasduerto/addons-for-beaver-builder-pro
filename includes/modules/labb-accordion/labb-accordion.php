<?php

/*
Widget Name: Livemesh Accordion
Description: Displays collapsible content panels to help display information when space is limited.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBAccordionModule extends FLBuilderModule {

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Accordion', 'livemesh-bb-addons'),
            'description' => __('Displays collapsible content panels to help display information when space is limited.', 'livemesh-bb-addons'),
            'group' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-accordion/',
            'url' => LABB_ADDONS_URL . 'labb-accordion/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));


        $this->add_css('dashicons');

    }


}

FLBuilder::register_module('LABBAccordionModule', array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'options_section' => array(
                    'title' => __('Options', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'style' => array(
                                'type' => 'select',
                                'label' => __('Choose Accordion Style', 'livemesh-bb-addons'),
                                'default' => 'style1',
                                'options' => array(
                                    'style1' => __('Style 1', 'livemesh-bb-addons'),
                                    'style2' => __('Style 2', 'livemesh-bb-addons'),
                                    'style3' => __('Style 3', 'livemesh-bb-addons'),
                                )
                            ),

                            'toggle' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Allow to function like toggle?', 'livemesh-bb-addons'),
                                'help' => __('Check if multiple elements can be open at the same time.', 'livemesh-bb-addons'),
                                'options' => array(
                                    'yes' => __('Yes', 'livemesh-bb-addons'),
                                    'no' => __('No', 'livemesh-bb-addons')
                                ),
                                'default' => 'no',
                                'toggle' => array(
                                    'yes' => array(
                                        'fields' => array('expanded')
                                    ),
                                )
                            ),

                            'expanded' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Start expanded?', 'livemesh-bb-addons'),
                                'help' => __('Check if you need all elements to be expanded initially. Works only if toggle flag above is checked and hence multiple accordion elements can be open at the same time.', 'livemesh-bb-addons'),
                                'default' => 'no',
                                'options' => array(
                                    'yes' => __('Yes', 'livemesh-bb-addons'),
                                    'no' => __('No', 'livemesh-bb-addons')
                                ),
                            ),
                        )
                ),

                'form_section' => array(
                    'title' => __('Panels', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'accordion' => array(
                                'type' => 'form',
                                'label' => __('Panel', 'livemesh-bb-addons'),
                                'form' => 'accordion_form',
                                'preview_text' => 'panel_title',
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
                        'title_active_color' => array(
                            'type' => 'color',
                            'label' => __('Active Title Color', 'livemesh-bb-addons'),
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

                        'text_color' => array(
                            'type' => 'color',
                            'label' => __('Text Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'text_font' => array(
                            'type' => 'font',
                            'label' => __('Text font', 'livemesh-bb-addons'),
                            'default' => array(
                                'family' => 'Default',
                                'weight' => 'default'
                            ),
                        ),
                        'text_font_size' => array(
                            'type' => 'unit',
                            'label' => __('Text Font Size', 'livemesh-bb-addons'),
                            'responsive' => true,
                            'description' => 'px'
                        ),
                        'text_line_height' => array(
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
FLBuilder::register_settings_form('accordion_form', array(
    'title' => __('Accordion Panel', 'livemesh-bb-addons'),
    'tabs' => array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'general' => array(
                    'title' => 'Enter Panel Data',

                    'fields' => array(
                        'panel_title' => array(
                            'type' => 'text',
                            'label' => __('Panel Title', 'livemesh-bb-addons'),
                            'help' => __('The title for the panel.', 'livemesh-bb-addons'),
                            'connections' => array('string', 'html'),
                        ),

                        'panel_id' => array(
                            'type' => 'text',
                            'label' => __('Panel ID', 'livemesh-bb-addons'),
                            'description' => __('The Panel ID is required to link to a panel. It must be unique across the page, must begin with a letter and may be followed by any number of letters, digits, hyphens or underscores.', 'livemesh-bb-addons'),
                            'connections' => array('string', 'html'),
                        ),

                        'panel_content' => array(
                            'type' => 'editor',
                            'label' => '',
                            'default' => __('Enter the collapsible content of the accordion panel here.', 'livemesh-bb-addons'),
                            'media_buttons' => true,
                            'rows' => 10,
                            'connections' => array('string', 'html'),
                        ),
                    )
                )
            )
        ),
    )
));