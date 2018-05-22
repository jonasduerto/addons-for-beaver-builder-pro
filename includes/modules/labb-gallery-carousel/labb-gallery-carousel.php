<?php

/*
Widget Name: Livemesh Gallery Carousel
Description: Display images or videos in a responsive carousel.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBGalleryCarouselModule extends FLBuilderModule {

    static public $gallery_counter = 0;

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Gallery Carousel', 'livemesh-bb-addons'),
            'description' => __('Display images or videos in a responsive carousel.', 'livemesh-bb-addons'),
            'group' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-gallery-carousel/',
            'url' => LABB_ADDONS_URL . 'labb-gallery-carousel/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));


        $this->add_js('slick');
        $this->add_css('slick');

    }

    public function enqueue_scripts() {
        parent::enqueue_scripts();

        if ($this->settings && $this->settings->enable_lightbox == 'yes') {

            $this->add_js('jquery-fancybox');
            $this->add_css('fancybox');
        }
    }

}


FLBuilder::register_module('LABBGalleryCarouselModule', array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(

                'options_section' => array(
                    'title' => __('Options', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'gallery_class' => array(
                                'type' => 'text',
                                'description' => __('Specify an unique identifier used as a custom CSS class name and lightbox group name/slug for the gallery carousel element.', 'livemesh-bb-addons'),
                                'label' => __('Gallery Class/Identifier', 'livemesh-bb-addons'),
                                'default' => ''
                            ),

                            'bulk_upload' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Bulk Upload?', 'livemesh-bb-addons'),
                                'default' => 'no',
                                'toggle' => array(
                                    'no' => array(
                                        'fields' => array('gallery_items')
                                    ),
                                    'yes' => array(
                                        'fields' => array('gallery_images')

                                    )
                                )
                            )
                        )
                ),

                'form_section' => array(
                    'title' => __('Gallery Items', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'gallery_images' => array(
                                'type' => 'multiple-photos',
                                'label' => __('Gallery Images', 'livemesh-bb-addons'),
                                'connections' => array('multiple-photos'),
                            ),

                            'gallery_items' => array(
                                'type' => 'form',
                                'label' => __('Gallery Item', 'livemesh-bb-addons'),
                                'form' => 'gallery_items_form',
                                'preview_text' => 'item_name',
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
                    'title' => __('Carousel Settings', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'image_size'    => array(
                                'type'          => 'photo-sizes',
                                'label'         => __( 'Image Size', 'labb-bb-addons' ),
                                'default'       => 'large',
                            ),

                            'crop'    => array(
                                'type'          => 'select',
                                'label'         => __( 'Crop Image', 'labb-bb-addons' ),
                                'default'       => 'landscape',
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

                            'enable_lightbox' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Enable Lightbox Gallery?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),


                            'arrows' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Prev/Next Arrows?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

                            'dots' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Show dot indicators for navigation?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

                            'pause_on_hover' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Pause on mouse hover?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

                            'autoplay' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Autoplay?', 'livemesh-bb-addons'),
                                'description' => __('Should the carousel autoplay as in a slideshow.', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

                            'autoplay_speed' => array(
                                'type' => 'labb-number',
                                'label' => __('Autoplay speed in ms', 'livemesh-bb-addons'),
                                'default' => 3000,
                                'min' => 1000,
                                'max' => 20000,
                                'description' => 'ms',
                            ),

                            'animation_speed' => array(
                                'type' => 'labb-number',
                                'label' => __('Autoplay animation speed in ms', 'livemesh-bb-addons'),
                                'default' => 600,
                                'min' => 100,
                                'max' => 2000,
                                'description' => 'ms',
                            ),
                        )
                ),
            )
        ),


        'layout' => array(
            'title' => __('Responsive', 'livemesh-bb-addons'),
            'sections' => array(
                'desktop_section' => array(
                    'title' => __('Desktop Options', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'display_columns' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns per row', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 5,
                                'default' => 3,
                                'description' => 'columns (max: 5)',
                                'connections' => array('custom_field')
                            ),

                            'scroll_columns' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns to scroll', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 5,
                                'default' => 3,
                                'maxlength' => '1',
                                'size' => '3',
                                'description' => 'columns (max: 5)',
                                'connections' => array('custom_field')
                            ),

                            'gutter' => array(
                                'type' => 'text',
                                'label' => __('Gutter', 'livemesh-bb-addons'),
                                'description' => __('Space between columns.', 'livemesh-bb-addons'),
                                'default' => '10',
                                'maxlength' => '2',
                                'size' => '4',
                                'description' => 'px',
                            ),
                        )
                ),
                'tablet_section' => array(
                    'title' => __('Tablet Options', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'tablet_display_columns' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns per row', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 3,
                                'default' => 2,
                                'description' => 'columns (max: 3)',
                                'connections' => array('custom_field')
                            ),
                            'tablet_scroll_columns' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns to scroll', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 3,
                                'default' => 2,
                                'description' => 'columns (max: 3)',
                                'connections' => array('custom_field')
                            ),
                            'tablet_gutter' => array(
                                'type' => 'text',
                                'label' => __('Gutter', 'livemesh-bb-addons'),
                                'description' => __('Space between columns.', 'livemesh-bb-addons'),
                                'default' => '10',
                                'maxlength' => '2',
                                'size' => '4',
                                'description' => 'px',
                            ),
                            'tablet_width' => array(
                                'type' => 'text',
                                'label' => __('Resolution', 'livemesh-bb-addons'),
                                'description' => __('The resolution to treat as a tablet resolution.', 'livemesh-bb-addons'),
                                'default' => '800',
                                'maxlength' => '4',
                                'size' => '5',
                                'description' => 'px',
                            )
                        )
                ),

                'mobile_section' => array(
                    'title' => __('Mobile Options', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'mobile_display_columns' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns per row', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 2,
                                'integer' => true,
                                'default' => 1,
                                'description' => 'columns (max: 2)',
                                'connections' => array('custom_field')
                            ),
                            'mobile_scroll_columns' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns to scroll', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 2,
                                'integer' => true,
                                'default' => 1,
                                'description' => 'columns (max: 2)',
                                'connections' => array('custom_field')
                            ),
                            'mobile_gutter' => array(
                                'type' => 'text',
                                'label' => __('Gutter', 'livemesh-bb-addons'),
                                'description' => __('Space between columns.', 'livemesh-bb-addons'),
                                'default' => '10',
                                'maxlength' => '2',
                                'size' => '4',
                                'description' => 'px',
                            ),
                            'mobile_width' => array(
                                'type' => 'text',
                                'label' => __('Resolution', 'livemesh-bb-addons'),
                                'description' => __('The resolution to treat as a mobile resolution.', 'livemesh-bb-addons'),
                                'default' => '480',
                                'maxlength' => '4',
                                'size' => '5',
                                'description' => 'px',
                            )
                        )
                )
            )
        ),

        'style' => array(
            'title' => __('Style', 'livemesh-bb-addons'),
            'sections' => array(
                'carousel_item_thumbnail_section' => array(
                    'title' => __('Gallery Thumbnail', 'livemesh-bb-addons'),
                    'fields' => array(

                        'thumbnail_hover_bg_color' => array(
                            'type' => 'color',
                            'label' => __('Thumbnail Hover Background Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'thumbnail_hover_opacity' => array(
                            'type' => 'labb-number',
                            'label' => __('Thumbnail Hover Opacity (%)', 'livemesh-bb-addons'),
                            'responsive' => true,
                            'description' => '%',
                            'min' => 1,
                            'max' => 100,
                            'default' => 50
                        ),
                    )
                ),
                'title_section' => array(
                    'title' => __('Gallery Item Title', 'livemesh-bb-addons'),
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
                        'title_hover_border_color' => array(
                            'type' => 'color',
                            'label' => __('Title Hover Border Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'title_font' => array(
                            'type' => 'font',
                            'label' => __('Title Font', 'livemesh-bb-addons'),
                            'default' => array(
                                'family' => 'Default',
                                'weight' => 'default'
                            ),
                        ),
                        'title_font_size' => array(
                            'type' => 'unit',
                            'label' => __('Title Font Size', 'livemesh-bb-addons'),
                            'responsive' => true,
                        ),
                        'title_line_height' => array(
                            'type' => 'unit',
                            'label' => __('Title Line height', 'livemesh-bb-addons'),
                            'responsive' => true,
                        ),
                    )
                ),

                'item_tags_section' => array(
                    'title' => __('Gallery Item Tags', 'livemesh-bb-addons'),
                    'fields' => array(

                        'tags_color' => array(
                            'type' => 'color',
                            'label' => __('Item Tags Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'tags_font' => array(
                            'type' => 'font',
                            'label' => __('Item Tags Font', 'livemesh-bb-addons'),
                            'default' => array(
                                'family' => 'Default',
                                'weight' => 'default'
                            ),
                        ),
                        'tags_font_size' => array(
                            'type' => 'unit',
                            'label' => __('Item Tags Font Size', 'livemesh-bb-addons'),
                            'responsive' => true,
                        ),
                        'tags_line_height' => array(
                            'type' => 'unit',
                            'label' => __('Item Tags Line height', 'livemesh-bb-addons'),
                            'responsive' => true,
                        ),
                    )
                ),

            )
        ),
    )
);


/**
 * Register a settings form to use in the 'form' field type above.
 */
FLBuilder::register_settings_form('gallery_items_form', array(
    'title' => __('Gallery Item', 'livemesh-bb-addons'),
    'tabs' => array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'general' => array(
                    'title' => 'Enter Gallery Item',

                    'fields' => array(
                        'item_type' => array(
                            'type' => 'select',
                            'label' => __('Item Type', 'livemesh-bb-addons'),
                            'description' => __('Specify the item type - if this is an image or represents a YouTube/Vimeo video.', 'livemesh-bb-addons'),
                            'default' => 'image',
                            'toggle' => array(
                                'image' => array(
                                    'fields' => array('item_link')
                                ),
                                'youtube' => array(
                                    'fields' => array('video_link'),
                                ),
                                'vimeo' => array(
                                    'fields' => array('video_link'),
                                ),
                                'html5video' => array(
                                    'fields' => array('mp4_video', 'webm_video'),
                                )
                            ),
                            'options' => array(
                                'image' => __('Image', 'livemesh-bb-addons'),
                                'youtube' => __('YouTube Video', 'livemesh-bb-addons'),
                                'vimeo' => __('Vimeo Video', 'livemesh-bb-addons'),
                                'html5video' => __('HTML5 Video', 'livemesh-bb-addons'),
                            ),
                            'connections' => array('custom_field')
                        ),
                        'item_name' => array(
                            'type' => 'text',
                            'label' => __('Item Label', 'livemesh-bb-addons'),
                            'description' => __('The label or name for the gallery item.', 'livemesh-bb-addons'),
                            'connections' => array('string', 'html'),
                        ),
                        'item_image' => array(
                            'type' => 'photo',
                            'label' => __('Gallery Image', 'livemesh-bb-addons'),
                            'description' => __('The image for the gallery item. If item type chosen is YouTube or Vimeo video, the image will be used as a placeholder image for video.', 'livemesh-bb-addons'),
                            'connections' => array('photo')
                        ),
                        'tags' => array(
                            'type' => 'text',
                            'label' => __('Item Tag(s)', 'livemesh-bb-addons'),
                            'description' => __('One or more comma separated tags for the gallery item. Useful when items are made filterable.', 'livemesh-bb-addons'),
                            'connections' => array('custom_field')
                        ),
                        'item_link' => array(
                            'type' => 'link',
                            'label' => __('Page URL', 'livemesh-bb-addons'),
                            'description' => __('The URL of the page to which the image gallery item points to (optional).', 'livemesh-bb-addons'),
                            'connections' => array('url'),
                        ),
                        'video_link' => array(
                            'type' => 'text',
                            'label' => __('Video URL', 'livemesh-bb-addons'),
                            'description' => __('The URL of the YouTube or Vimeo video.', 'livemesh-bb-addons'),
                            'connections' => array('custom_field'),
                        ),
                        'mp4_video' => array(
                            'type' => 'video',
                            'label' => __('MP4 Video', 'livemesh-bb-addons'),
                            'description' => __('Choose a MP4 video uploaded to the media library.', 'livemesh-bb-addons'),
                            'connections' => array('custom_field'),
                        ),
                        'webm_video' => array(
                            'type' => 'video',
                            'label' => __('WebM Video', 'livemesh-bb-addons'),
                            'description' => __('Choose a WebM video uploaded to the media library.', 'livemesh-bb-addons'),
                            'connections' => array('custom_field'),
                        ),
                        'item_description' => array(
                            'type' => 'textarea',
                            'label' => __('Item Description', 'livemesh-bb-addons'),
                            'description' => __('Short description for the gallery item displayed in the lightbox gallery.', 'livemesh-bb-addons'),
                            'connections' => array('string', 'html'),
                            'default' => ''
                        ),

                    )
                )
            )
        ),
    )
));