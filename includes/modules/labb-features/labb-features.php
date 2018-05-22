<?php

/*
Widget Name: Livemesh Features
Description: Display product features or services offered
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBFeaturesModule extends FLBuilderModule {

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Features', 'livemesh-bb-addons'),
            'description' => __('Display product features or services offered.', 'livemesh-bb-addons'),
            'group' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'group' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-features/',
            'url' => LABB_ADDONS_URL . 'labb-features/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));

        $this->add_js('jquery-waypoints');
        $this->add_css('animate');

    }

}


FLBuilder::register_module('LABBFeaturesModule', array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'options_section' => array(
                    'title' => __('Options', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(
                            'container_class' => array(
                                'type' => 'text',
                                'label' => esc_html__('Features Container Class', 'livemesh-bb-addons'),
                                'description' => esc_html__('The CSS class for the features container DIV element.', 'livemesh-bb-addons'),
                            ),

                            'image_size'    => array(
                                'type'          => 'photo-sizes',
                                'label'         => __( 'Image Size', 'labb-bb-addons' ),
                                'default'       => 'large',
                            ),

                            'crop'    => array(
                                'type'          => 'select',
                                'label'         => __( 'Crop Image', 'labb-bb-addons' ),
                                'default'       => '',
                                'options'       => array(
                                    ''              => _x( 'None', 'Photo Crop.', 'labb-bb-addons' ),
                                    'landscape'     => __( 'Landscape', 'labb-bb-addons' ),
                                    'panorama'      => __( 'Panorama', 'labb-bb-addons' ),
                                    'portrait'      => __( 'Portrait', 'labb-bb-addons' ),
                                    'square'        => __( 'Square', 'labb-bb-addons' ),
                                ),
                            ),

                        )
                ),

                'form_section' => array(
                    'title' => __('Features', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(
                            'features' => array(
                                'type' => 'form',
                                'label' => __('Feature', 'livemesh-bb-addons'),
                                'form' => 'features_form',
                                'preview_text' => 'feature_title',
                                'multiple' => true
                            ),
                        )
                )
            )
        ),


        'style' => array(
            'title' => __('Style', 'livemesh-bb-addons'),
            'sections' => array(
                'features_styling_section' => array(
                    'title' => __('General', 'livemesh-bb-addons'),
                    'fields' => array(

                        'tiled' => array(
                            'type' => 'labb-toggle-button',
                            'label' => __('Apply tiled design?', 'livemesh-bb-addons'),
                            'default' => 'no',
                            'toggle' => array(
                                'no' => array(
                                    'fields' => array('features_spacing')
                                )
                            ),
                        ),
                        'features_spacing' => array(
                            'type' => 'labb-number',
                            'label' => __('Features Spacing', 'livemesh-bb-addons'),
                            'description' => __('px', 'livemesh-bb-addons'),
                        ),
                    )
                ),
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
                        'title_text_transform'  => array(
                            'type'          => 'select',
                            'label'         => __('Text Transform', 'livemesh-bb-addons'),
                            'default'       => 'none',
                            'options'       => array(
                                'none' 			=> __( 'Default', 'livemesh-bb-addons' ),
                                'capitalize' 	=> __( 'Capitalize', 'livemesh-bb-addons' ),
                                'uppercase' 	=> __( 'Uppercase', 'livemesh-bb-addons' ),
                                'lowercase' 	=> __( 'Lowercase', 'livemesh-bb-addons' ),
                                'initial' 		=> __( 'Initial', 'livemesh-bb-addons' ),
                                'inherit' 		=> __( 'Inherit', 'livemesh-bb-addons' ),
                            ),
                        ),
                    )
                ),
                'subtitle_section' => array(
                    'title' => __('Features Subtitle', 'livemesh-bb-addons'),
                    'fields' => array(


                        'subtitle_color' => array(
                            'type' => 'color',
                            'label' => __('Subtitle Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'subtitle_font' => array(
                            'type' => 'font',
                            'label' => __('Subtitle font', 'livemesh-bb-addons'),
                            'default' => array(
                                'family' => 'Default',
                                'weight' => 'default'
                            ),
                        ),
                        'subtitle_font_size' => array(
                            'type' => 'unit',
                            'label' => __('Subtitle Font Size', 'livemesh-bb-addons'),
                            'responsive' => true,
                            'description' => 'px'
                        ),
                        'subtitle_line_height' => array(
                            'type' => 'unit',
                            'label' => __('Subtitle Line height', 'livemesh-bb-addons'),
                            'responsive' => true,
                            'description' => 'px'
                        ),
                        'subtitle_text_transform'  => array(
                            'type'          => 'select',
                            'label'         => __('Text Transform', 'livemesh-bb-addons'),
                            'default'       => 'none',
                            'options'       => array(
                                'none' 			=> __( 'Default', 'livemesh-bb-addons' ),
                                'capitalize' 	=> __( 'Capitalize', 'livemesh-bb-addons' ),
                                'uppercase' 	=> __( 'Uppercase', 'livemesh-bb-addons' ),
                                'lowercase' 	=> __( 'Lowercase', 'livemesh-bb-addons' ),
                                'initial' 		=> __( 'Initial', 'livemesh-bb-addons' ),
                                'inherit' 		=> __( 'Inherit', 'livemesh-bb-addons' ),
                            ),
                        ),
                    )
                ),
                'content_section' => array(
                    'title' => __('Short Text', 'livemesh-bb-addons'),
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
FLBuilder::register_settings_form('features_form', array(
    'title' => __('Feature', 'livemesh-bb-addons'),
    'tabs' => array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'general' => array(
                    'title' => 'Enter Feature Information',

                    'fields' => array(
                        'feature_title' => array(
                            'type' => 'text',
                            'label' => esc_html__('Feature Title', 'livemesh-bb-addons'),
                            'description' => esc_html__('The title for the feature.', 'livemesh-bb-addons'),
                            'connections' => array('string', 'html'),
                        ),

                        'feature_subtitle' => array(
                            'type' => 'text',
                            'label' => esc_html__('Feature Subtitle', 'livemesh-bb-addons'),
                            'description' => esc_html__('The subtitle for the feature.', 'livemesh-bb-addons'),
                            'connections' => array('string', 'html'),
                        ),

                        'feature_image' => array(
                            'type' => 'photo',
                            'library' => 'image',
                            'label' => esc_html__('Feature Image.', 'livemesh-bb-addons'),
                            'description' => esc_html__('An icon image or a bitmap which best represents the feature we are capturing', 'livemesh-bb-addons'),
                            'fallback' => true,
                            'connections' => array('photo')
                        ),

                        'feature_text' => array(
                            'type' => 'editor',
                            'description' => esc_html__('The feature content.', 'livemesh-bb-addons'),
                            'label' => '',
                            'default' => esc_html__('Feature content goes here.', 'livemesh-bb-addons'),
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
                        'feature_class' => array(
                            'type' => 'text',
                            'label' => esc_html__('Feature Class', 'livemesh-bb-addons'),
                            'description' => esc_html__('The CSS class for the feature DIV element.', 'livemesh-bb-addons'),
                        ),
                        'image_animation' => array(
                            'type' => 'select',
                            'label' => __('Animation for Feature Image', 'livemesh-bb-addons'),
                            'default' => 'none',
                            'options' => labb_get_animation_options(),
                        ),

                        'text_animation' => array(
                            'type' => 'select',
                            'label' => __('Animation for Feature Text', 'livemesh-bb-addons'),
                            'default' => 'none',
                            'options' => labb_get_animation_options(),
                        ),
                    )
                )
            )
        ),
    )
));