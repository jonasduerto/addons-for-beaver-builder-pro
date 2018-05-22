<?php

/*
Widget Name: Livemesh Image Slider
Description: Create a responsive image slider.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/


class LABBImageSliderModule extends FLBuilderModule {

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Image Slider', 'livemesh-bb-addons'),
            'description' => __('Create a responsive image slider.', 'livemesh-bb-addons'),
            'group' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-image-slider/',
            'url' => LABB_ADDONS_URL . 'labb-image-slider/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));

    }

    public function enqueue_scripts() {
        parent::enqueue_scripts();

        if ($this->settings && $this->settings->slider_type == 'flex') {
            $this->add_js('jquery-flexslider');
            $this->add_css('flexslider');
        }
        elseif ($this->settings && $this->settings->slider_type == 'nivo') {
            $this->add_js('jquery-nivo');
            $this->add_css('nivo-slider');
        }
        elseif ($this->settings && $this->settings->slider_type == 'slick') {
            $this->add_js('slick');
            $this->add_css('slick');
        }
        elseif ($this->settings && $this->settings->slider_type == 'responsive') {
            $this->add_js('responsiveslides');
            $this->add_css('responsiveslides');
        }
    }

    function get_theme_color() {

        return labb_get_theme_color();

    }

}


FLBuilder::register_module('LABBImageSliderModule', array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(

                'options_section' => array(
                    'title' => __('Options', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            "class" => array(
                                "type" => "text",
                                "description" => __("Set a unique CSS class for the slider. (optional).", "livemesh-bb-addons"),
                                "label" => __("Class", "livemesh-bb-addons"),
                            ),

                            'caption_style' => array(
                                'type' => 'select',
                                'label' => __('Choose Caption Style', 'livemesh-bb-addons'),
                                'default' => 'style1',
                                'options' => array(
                                    'style1' => __('Style 1', 'livemesh-bb-addons'),
                                    'style2' => __('Style 2', 'livemesh-bb-addons'),
                                ),
                                'connections' => array('custom_field')
                            ),

                            'bulk_upload' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Bulk Image Upload?', 'livemesh-bb-addons'),
                                'default' => 'no',
                                'toggle' => array(
                                    'no' => array(
                                        'fields' => array('image_slides')
                                    ),
                                    'yes' => array(
                                        'fields' => array('image_gallery')
                                    )
                                )
                            )
                        )
                ),

                'form_section' => array(
                    'title' => __('Image Slides', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'image_gallery' => array(
                                'type' => 'multiple-photos',
                                'label' => __('Image Gallery', 'livemesh-bb-addons'),
                                'connections' => array('multiple-photos'),
                            ),

                            'image_slides' => array(
                                'type' => 'form',
                                'label' => __('Image Slides', 'livemesh-bb-addons'),
                                'form' => 'image_slides_form',
                                'preview_text' => 'slide_title',
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

                            'image_size'    => array(
                                'type'          => 'photo-sizes',
                                'label'         => __( 'Image Size', 'labb-bb-addons' ),
                                'default'       => 'full',
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

                            'link_target' => array(
                                'type' => 'select',
                                'label' => __('Link Target', 'livemesh-bb-addons'),
                                'default' => '_self',
                                'options' => array(
                                    '_self' => __('Same Window', 'livemesh-bb-addons'),
                                    '_blank' => __('New Window', 'livemesh-bb-addons'),
                                ),
                                'preview' => array(
                                    'type' => 'none',
                                ),
                            ),

                            'slider_type' => array(
                                'type' => 'select',
                                'description' => __('Select slider type.', 'livemesh-bb-addons'),
                                'label' => __('Slider Type', 'livemesh-bb-addons'),
                                'options' => array(
                                    'flex' => __('Flex Slider', 'livemesh-bb-addons'),
                                    'nivo' => __('Nivo Slider', 'livemesh-bb-addons'),
                                    'slick' => __('Slick Slider', 'livemesh-bb-addons'),
                                    'responsive' => __('Responsive Slider', 'livemesh-bb-addons'),
                                ),
                                'toggle' => array(
                                    'flex' => array(
                                        'fields' => array('slide_animation', 'thumbnail_nav', 'pause_on_action', 'direction', 'randomize', 'loop')
                                    ),
                                    'nivo' => array(
                                        'fields' => array('thumbnail_nav')
                                    ),
                                    'slick' => array(
                                        'fields' => array('direction', 'loop'),
                                    ),
                                    'responsive' => array(
                                        'fields' => array('randomize'),
                                    )
                                ),
                                'default' => 'flex',
                                'connections' => array('custom_field')
                            ),
                            'slide_animation' => array(
                                'type' => 'select',
                                'description' => __('Select your animation type.', 'livemesh-bb-addons'),
                                'label' => __('Animation', 'livemesh-bb-addons'),
                                'options' => array(
                                    'slide' => __('Slide', 'livemesh-bb-addons'),
                                    'fade' => __('Fade', 'livemesh-bb-addons'),
                                ),
                                'default' => 'slide',
                                'state_handler' => array(
                                    'slider_type[flex]' => array('show'),
                                    '_else[slider_type]' => array('hide'),
                                ),
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
                                'state_handler' => array(
                                    'slider_type[flex]' => array('show'),
                                    'slider_type[slick]' => array('show'),
                                    '_else[slider_type]' => array('hide'),
                                ),
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
                            'thumbnail_nav' => array(
                                'type' => 'labb-toggle-button',
                                'description' => __('Use thumbnails for Control Nav?', 'livemesh-bb-addons'),
                                'label' => __('Thumbnails Navigation?', 'livemesh-bb-addons'),
                                'default' => 'no',
                                'state_handler' => array(
                                    'slider_type[nivo]' => array('show'),
                                    'slider_type[flex]' => array('show'),
                                    '_else[slider_type]' => array('hide'),
                                ),
                            ),
                            'randomize' => array(
                                'type' => 'labb-toggle-button',
                                'description' => __('Randomize slide order?', 'livemesh-bb-addons'),
                                'label' => __('Randomize slides?', 'livemesh-bb-addons'),
                                'default' => 'no',
                                'state_handler' => array(
                                    'slider_type[flex]' => array('show'),
                                    'slider_type[nivo]' => array('hide'),
                                    'slider_type[slick]' => array('hide'),
                                    'slider_type[responsive]' => array('show'),
                                ),
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
                                'state_handler' => array(
                                    'slider_type[flex]' => array('show'),
                                    '_else[slider_type]' => array('hide'),
                                ),
                            ),
                            'loop' => array(
                                'type' => 'labb-toggle-button',
                                'description' => __('Should the animation loop?', 'livemesh-bb-addons'),
                                'label' => __('Loop', 'livemesh-bb-addons'),
                                'default' => 'yes',
                                'state_handler' => array(
                                    'slider_type[flex]' => array('show'),
                                    'slider_type[slick]' => array('show'),
                                    '_else[slider_type]' => array('hide'),
                                ),
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

                'slide_thumbnail_section' => array(
                    'title' => __('Slide Image', 'livemesh-bb-addons'),
                    'fields' => array(

                        'thumbnail_overlay_opacity' => array(
                            'type' => 'labb-number',
                            'label' => __('Image Overlay Opacity (%)', 'livemesh-bb-addons'),
                            'responsive' => true,
                            'description' => '%',
                            'min' => 1,
                            'max' => 100,
                            'default' => 40
                        ),
                        'thumbnail_hover_overlay_opacity' => array(
                            'type' => 'labb-number',
                            'label' => __('Image Overlay Hover Opacity (%)', 'livemesh-bb-addons'),
                            'responsive' => true,
                            'description' => '%',
                            'min' => 1,
                            'max' => 100,
                            'default' => 20
                        ),
                    )
                ),
                'caption_heading_section' => array(
                    'title' => __('Caption Heading', 'livemesh-bb-addons'),
                    'fields' => array(

                        'heading_tag' => array(
                            'type' => 'select',
                            'label' => __('Heading HTML Tag', 'livemesh-bb-addons'),
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

                        'heading_color' => array(
                            'type' => 'color',
                            'label' => __('Heading Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'heading_hover_color' => array(
                            'type' => 'color',
                            'label' => __('Heading Hover Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'heading_hover_border_color' => array(
                            'type' => 'color',
                            'label' => __('Heading Hover Border Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'heading_font' => array(
                            'type' => 'font',
                            'label' => __('Heading font', 'livemesh-bb-addons'),
                            'default' => array(
                                'family' => 'Default',
                                'weight' => 'default'
                            ),
                        ),
                        'heading_font_size' => array(
                            'type' => 'unit',
                            'label' => __('Heading Font Size', 'livemesh-bb-addons'),
                            'responsive' => true,
                            'description' => 'px'
                        ),
                        'heading_line_height' => array(
                            'type' => 'unit',
                            'label' => __('Heading Line height', 'livemesh-bb-addons'),
                            'responsive' => true,
                            'description' => 'px'
                        ),
                        'heading_text_transform'  => array(
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
                'subheading_section' => array(
                    'title' => __('Caption Subheading', 'livemesh-bb-addons'),
                    'fields' => array(


                        'subheading_color' => array(
                            'type' => 'color',
                            'label' => __('Subheading Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'subheading_font' => array(
                            'type' => 'font',
                            'label' => __('Subheading font', 'livemesh-bb-addons'),
                            'default' => array(
                                'family' => 'Default',
                                'weight' => 'default'
                            ),
                        ),
                        'subheading_font_size' => array(
                            'type' => 'unit',
                            'label' => __('Subheading Font Size', 'livemesh-bb-addons'),
                            'responsive' => true,
                            'description' => 'px'
                        ),
                        'subheading_line_height' => array(
                            'type' => 'unit',
                            'label' => __('Subheading Line height', 'livemesh-bb-addons'),
                            'responsive' => true,
                            'description' => 'px'
                        ),
                        'subheading_text_transform'  => array(
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
                        'subheading_font_style' => array(
                            'type' => 'select',
                            'label' => __('Font Style', 'livemesh-bb-addons'),
                            'default' => 'none',
                            'options' => array(
                                'none' => __('Default', 'livemesh-bb-addons'),
                                'normal' => __('Normal', 'livemesh-bb-addons'),
                                'italic' => __('Italic', 'livemesh-bb-addons'),
                                'oblique' => __('Oblique', 'livemesh-bb-addons'),
                            ),
                        ),
                    )
                ),
                'botton_section' => array(
                    'title' => __('Caption Button', 'livemesh-bb-addons'),
                    'fields' => array(

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
                        'button_text_color' => array(
                            'type' => 'color',
                            'label' => __('Button Text Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'button_text_font' => array(
                            'type' => 'font',
                            'label' => __('Button Text font', 'livemesh-bb-addons'),
                            'default' => array(
                                'family' => 'Default',
                                'weight' => 'default'
                            ),
                        ),
                        'button_text_font_size' => array(
                            'type' => 'unit',
                            'label' => __('Button Text Font Size', 'livemesh-bb-addons'),
                            'responsive' => true,
                            'description' => 'px'
                        ),
                        'button_text_line_height' => array(
                            'type' => 'unit',
                            'label' => __('Button Text Line height', 'livemesh-bb-addons'),
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
FLBuilder::register_settings_form('image_slides_form', array(
    'title' => __('Image Slide', 'livemesh-bb-addons'),
    'tabs' => array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'general' => array(
                    'title' => 'Enter Slide Info',

                    'fields' => array(
                        'slide_title' => array(
                            'type' => 'text',
                            'label' => __('Name', 'livemesh-bb-addons'),
                            'description' => __('The title to identify the slide', 'livemesh-bb-addons'),
                            'connections' => array('string', 'html'),
                        ),
                        'slide_image' => array(
                            'type' => 'photo',
                            'label' => __('Slide Image', 'livemesh-bb-addons'),
                            'description' => __('The image for the slide.', 'livemesh-bb-addons'),
                            'connections' => array('photo')
                        ),
                        'slide_url' => array(
                            'type' => 'link',
                            'label' => __('URL to link to by image and caption heading.', 'livemesh-bb-addons'),
                            'description' => __('Specify the URL to which the slide image and caption heading should link to. (optional)', 'livemesh-bb-addons'),
                            'connections' => array('url'),
                        ),
                    )
                )
            )
        ),

        'caption' => array(
            'title' => __('Caption', 'livemesh-bb-addons'),
            'sections' => array(
                'caption_general' => array(
                    'title' => 'Caption Heading',

                    'fields' => array(
                        'heading' => array(
                            'type' => 'text',
                            'label' => __('Caption Heading', 'livemesh-bb-addons'),
                        ),
                        'subheading' => array(
                            'type' => 'text',
                            'label' => __('Caption Sub-heading', 'livemesh-bb-addons'),
                            'optional' => 'true',
                        ),
                    )
                ),
                'caption_button' => array(
                    'title' => 'Caption Button',

                    'fields' => array(
                        'button_text' => array(
                            'type' => 'text',
                            'label' => __('Button text', 'livemesh-bb-addons'),
                            'state_handler' => array(
                                'slider_type[nivo]' => array('hide'),
                                '_else[slider_type]' => array('show'),
                            ),
                        ),
                        'button_url' => array(
                            'type' => 'link',
                            'label' => __('Button URL', 'livemesh-bb-addons'),
                        ),
                        'new_window' => array(
                            'type' => 'labb-toggle-button',
                            'label' => __('Open URL in a new window', 'livemesh-bb-addons'),
                            'default' => 'yes'
                        ),
                        "button_color" => array(
                            "type" => "select",
                            "description" => __("The color of the button.", "livemesh-bb-addons"),
                            "label" => __("Color", "livemesh-bb-addons"),
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
                            "default" => "default"
                        ),
                        "button_type" => array(
                            "type" => "select",
                            "label" => __("Button Size", "livemesh-bb-addons"),
                            "options" => array(
                                "medium" => __("Medium", "livemesh-bb-addons"),
                                "large" => __("Large", "livemesh-bb-addons"),
                                "small" => __("Small", "livemesh-bb-addons"),
                            )
                        ),
                        'rounded' => array(
                            'type' => 'labb-toggle-button',
                            'label' => __('Display rounded button?', 'livemesh-bb-addons'),
                            'default' => 'no'
                        ),
                    )
                )
            )
        ),
    )
));


