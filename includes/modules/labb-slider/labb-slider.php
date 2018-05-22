<?php

/*
Widget Name: Livemesh Slider
Description: Create a responsive slider of custom HTML content.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/


class LABBSliderModule extends FLBuilderModule {

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Slider', 'livemesh-bb-addons'),
            'description' => __('Create a responsive slider of custom HTML content.', 'livemesh-bb-addons'),
            'group' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-slider/',
            'url' => LABB_ADDONS_URL . 'labb-slider/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));

        $this->add_js( 'jquery-flexslider' );
        $this->add_css( 'flexslider' );

    }

}


FLBuilder::register_module('LABBSliderModule', array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),

            'options_section' => array(
                'title' => __('Options', 'livemesh-bb-addons'), // Section Title
                'fields' =>
                    array(

                        "class" => array(
                            "type" => "text",
                            "description" => __("Set a unique CSS class for the slider. (optional).", "livemesh-bb-addons"),
                            "label" => __("Class", "livemesh-bb-addons"),
                        ),
                    )
            ),
            'sections' => array(

                'form_section' => array(
                    'title' => __('Slides', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'slides' => array(
                                'type' => 'form',
                                'label' => __('HTML Slide', 'livemesh-bb-addons'),
                                'form' => 'slides_form',
                                'preview_text' => 'slide_name',
                                'multiple' => true
                            ),
                        )
                )
            )
        ),
        'settings' => array(
            'title' => __('Settings', 'livemesh-bb-addons'),
            'sections' => array(
                'options_section' => array(
                    'title' => __('Slider Settings', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'slide_animation' => array(
                                'type' => 'select',
                                'description' => __('Select your animation type.', 'livemesh-bb-addons'),
                                'label' => __('Animation', 'livemesh-bb-addons'),
                                'options' => array(
                                    'slide' => __('Slide', 'livemesh-bb-addons'),
                                    'fade' => __('Fade', 'livemesh-bb-addons'),
                                ),
                                'default' => 'slide',
                            ),
                            'direction' => array(
                                'type' => 'select',
                                'description' => __('Select the sliding direction.', 'livemesh-bb-addons'),
                                'label' => __('Sliding Direction', 'livemesh-bb-addons'),
                                'options' => array(
                                    'horizontal' => __('Horizontal', 'livemesh-bb-addons'),
                                    'vertical' => __('Vertical', 'livemesh-bb-addons'),
                                ),
                                'default' => 'horizontal',
                            ),
                            'control_nav' => array(
                                'type' => 'labb-toggle-button',
                                'description' => __('Create navigation for paging control of each slide?', 'livemesh-bb-addons'),
                                'label' => __('Control navigation?', 'livemesh-bb-addons'),
                                'default' => 'yes',
                            ),
                            'direction_nav' => array(
                                'type' => 'labb-toggle-button',
                                'description' => __('Create navigation for previous/next navigation?', 'livemesh-bb-addons'),
                                'label' => __('Direction navigation?', 'livemesh-bb-addons'),
                                'default' => 'no',
                            ),
                            'randomize' => array(
                                'type' => 'labb-toggle-button',
                                'description' => __('Randomize slide order?', 'livemesh-bb-addons'),
                                'label' => __('Randomize slides?', 'livemesh-bb-addons'),
                                'default' => 'no',
                            ),
                            'pause_on_hover' => array(
                                'type' => 'labb-toggle-button',
                                'description' => __('Pause the slideshow when hovering over slider, then resume when no longer hovering.', 'livemesh-bb-addons'),
                                'label' => __('Pause on hover?', 'livemesh-bb-addons'),
                                'default' => 'yes',
                            ),
                            'pause_on_action' => array(
                                'type' => 'labb-toggle-button',
                                'description' => __('Pause the slideshow when interacting with control elements.', 'livemesh-bb-addons'),
                                'label' => __('Pause on action?', 'livemesh-bb-addons'),
                                'default' => 'yes',
                            ),
                            'loop' => array(
                                'type' => 'labb-toggle-button',
                                'description' => __('Should the animation loop?', 'livemesh-bb-addons'),
                                'label' => __('Loop', 'livemesh-bb-addons'),
                                'default' => 'yes',
                            ),
                            'slideshow' => array(
                                'type' => 'labb-toggle-button',
                                'description' => __('Animate slider automatically without user intervention?', 'livemesh-bb-addons'),
                                'label' => __('Slideshow', 'livemesh-bb-addons'),
                                'default' => 'yes',
                            ),
                            'slideshow_speed' => array(
                                'type' => 'labb-number',
                                'description' => __('Set the speed of the slideshow cycling, in milliseconds', 'livemesh-bb-addons'),
                                'label' => __('Slideshow speed', 'livemesh-bb-addons'),
                                'default' => 5000,
                                'min' => 1000,
                                'max' => 20000,
                                'description' => 'ms',
                            ),
                            'animation_speed' => array(
                                'type' => 'labb-number',
                                'description' => __('Set the speed of animations, in milliseconds.', 'livemesh-bb-addons'),
                                'label' => __('Animation speed', 'livemesh-bb-addons'),
                                'default' => 600,
                                'min' => 100,
                                'max' => 2000,
                                'description' => 'ms',
                            ),
                        )
                ),
            )
        ),


        'style' => array(
            'title' => __('Style', 'livemesh-bb-addons'),
            'sections' => array(
                'content_section' => array(
                    'title' => __('Slider Content', 'livemesh-bb-addons'),
                    'fields' => array(

                        'content_color' => array(
                            'type' => 'color',
                            'label' => __('Text Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),

                        'content_bg_color' => array(
                            'type' => 'color',
                            'label' => __('Text Background Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),

                        'content_padding' => array(
                            'type' => 'labb-number',
                            'label' => __('Text padding', 'livemesh-bb-addons'),
                            'description' => 'px'

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
                            'description' => 'px',
                            'responsive' => true,
                        ),
                        'content_line_height' => array(
                            'type' => 'unit',
                            'label' => __('Text Line height', 'livemesh-bb-addons'),
                            'description' => 'px',
                            'responsive' => true,
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
FLBuilder::register_settings_form('slides_form', array(
    'title' => __('HTML Slide', 'livemesh-bb-addons'),
    'tabs' => array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'general' => array(
                    'title' => 'Enter HTML Content',

                    'fields' => array(
                        'slide_name' => array(
                            'type' => 'text',
                            'label' => __('Title', 'livemesh-bb-addons'),
                            'description' => __('The title to identify the HTML slide', 'livemesh-bb-addons'),
                        ),

                        'slide_text' => array(
                            'type' => 'editor',
                            'label' => '',
                            'default' => __('The HTML content for the slide.', 'livemesh-bb-addons'),
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

