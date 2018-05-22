<?php

/*
Widget Name: Livemesh Gallery
Description: Display images or videos in a multi-column grid.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBGalleryModule extends FLBuilderModule {

    static public $gallery_counter = 0;

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Gallery', 'livemesh-bb-addons'),
            'description' => __('Display images or videos in a multi-column grid.', 'livemesh-bb-addons'),
            'group' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-gallery/',
            'url' => LABB_ADDONS_URL . 'labb-gallery/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));

        $this->add_js('isotope.pkgd');
        $this->add_js('imagesloaded.pkgd');

        add_action('wp_enqueue_scripts', array($this, 'localize_scripts'), 999999);
    }

    public function enqueue_scripts() {
        parent::enqueue_scripts();

        if ($this->settings && $this->settings->enable_lightbox == 'yes') {

            $this->add_js('jquery-fancybox');
            $this->add_css('fancybox');
        }
    }

    public function localize_scripts() {

        /* Do not attach to widget scripts since they are enqueued really late for some reason */
        wp_localize_script('labb-frontend-scripts', 'labb_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

    }

    function get_settings_data_atts() {

        $data_atts = array();

        $data_atts['gallery_class'] = $this->settings->gallery_class;

        $data_atts['heading'] = $this->settings->heading;

        $data_atts['bulk_upload'] = $this->settings->bulk_upload;

        $data_atts['layout_mode'] = $this->settings->layout_mode;

        $data_atts['image_size'] = $this->settings->image_size;

        $data_atts['crop'] = $this->settings->crop;

        $data_atts['link_target'] = $this->settings->link_target;

        $data_atts['filterable'] = $this->settings->filterable;

        $data_atts['enable_lightbox'] = $this->settings->enable_lightbox;

        $data_atts['display_item_title'] = $this->settings->display_item_title;

        $data_atts['display_item_tags'] = $this->settings->display_item_tags;

        $data_atts['pagination'] = $this->settings->pagination;

        $data_atts['show_remaining'] = $this->settings->show_remaining;

        $data_atts['items_per_page'] = $this->settings->items_per_page;

        $data_atts['per_line'] = $this->settings->per_line;

        $data_atts['per_line_tablet'] = $this->settings->per_line_tablet;

        $data_atts['per_line_mobile'] = $this->settings->per_line_mobile;

        $data_atts['heading_tag'] = $this->settings->heading_tag;

        $data_atts['title_tag'] = $this->settings->title_tag;

        return $data_atts;

    }

    function get_theme_color() {

        return labb_get_theme_color();

    }
}


FLBuilder::register_module('LABBGalleryModule', array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'options_section' => array(
                    'title' => __('Options', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'gallery_class' => array(
                                'type' => 'text',
                                'description' => __('Specify an unique identifier used as a custom CSS class name and lightbox group name/slug for the gallery element.', 'livemesh-bb-addons'),
                                'label' => __('Gallery Class/Identifier', 'livemesh-bb-addons'),
                                'default' => ''
                            ),

                            'heading' => array(
                                'type' => 'text',
                                'label' => __('Heading for the grid', 'livemesh-bb-addons'),
                                'connections' => array('string', 'html'),
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
                    'title' => __('General', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(
                            'layout_mode' => array(
                                'type' => 'select',
                                'label' => __('Choose a layout for the grid', 'livemesh-bb-addons'),
                                'default' => 'fitRows',
                                'options' => array(
                                    'fitRows' => __('Fit Rows', 'livemesh-bb-addons'),
                                    'masonry' => __('Masonry', 'livemesh-bb-addons'),
                                ),
                                'connections' => array('custom_field')
                            ),

                            'image_size' => array(
                                'type' => 'photo-sizes',
                                'label' => __('Image Size', 'labb-bb-addons'),
                                'default' => 'large',
                            ),

                            'crop' => array(
                                'type' => 'select',
                                'label' => __('Crop Image', 'labb-bb-addons'),
                                'default' => 'landscape',
                                'options' => array(
                                    '' => _x('None', 'Photo Crop.', 'labb-bb-addons'),
                                    'landscape' => __('Landscape', 'labb-bb-addons'),
                                    'panorama' => __('Panorama', 'labb-bb-addons'),
                                    'portrait' => __('Portrait', 'labb-bb-addons'),
                                    'square' => __('Square', 'labb-bb-addons'),
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

                            'filterable' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Filterable?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

                            'enable_lightbox' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Enable Lightbox Gallery?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

                            'display_item_title' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Display Item Title?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

                            'display_item_tags' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Display Item Tags?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),
                        )
                ),
                'pagination_section' => array(
                    'title' => __('Pagination', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'pagination' => array(
                                'type' => 'select',
                                'label' => __('Pagination', 'livemesh-bb-addons'),
                                'description' => __('Choose pagination type or choose None if no pagination is desired. Make sure you enter the items per page value in the option \'Number of items to be displayed per page and on each load more invocation\' field below to control number of items to display per page.', 'livemesh-bb-addons'),
                                'default' => 'none',
                                'options' => array(
                                    'none' => __('None', 'livemesh-bb-addons'),
                                    'paged' => __('Paged', 'livemesh-bb-addons'),
                                    'load_more' => __('Load More', 'livemesh-bb-addons'),
                                ),
                                'toggle' => array(
                                    'none' => array(
                                        'fields' => array(),
                                    ),

                                    'paged' => array(
                                        'sections' => array('pagination_styling_section', 'pagination_text_section'),
                                        'fields' => array('items_per_page'),
                                    ),
                                    'load_more' => array(
                                        'fields' => array('show_remaining', 'items_per_page'),
                                    ),
                                ),
                                'connections' => array('custom_field'),
                            ),

                            'show_remaining' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Display count of items yet to be loaded with the load more button?', 'livemesh-bb-addons'),
                                'default' => 'yes',
                            ),

                            'items_per_page' => array(
                                'type' => 'labb-number',
                                'label' => __('Number of items to be displayed per page and on each load more invocation.', 'livemesh-bb-addons'),
                                'default' => 8,
                                'connections' => array('custom_field'),
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

                            'per_line' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns per row', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 6,
                                'default' => 3,
                                'description' => 'Gallery Items per row (max: 6)',
                                'connections' => array('custom_field')
                            ),

                            'per_line_tablet' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns in Tablet Resolution', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 6,
                                'default' => 2,
                                'description' => 'Gallery Items per row (max: 6)',
                                'connections' => array('custom_field')
                            ),

                            'per_line_mobile' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns in Mobile Resolution', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 4,
                                'default' => 1,
                                'description' => 'Gallery Items per row (max: 4)',
                                'connections' => array('custom_field')
                            ),

                            'gutter' => array(
                                'type' => 'text',
                                'label' => __('Gutter', 'livemesh-bb-addons'),
                                'description' => __('Space between columns in masonry grid.', 'livemesh-bb-addons'),
                                'default' => '20',
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
                                'description' => __('The resolution in pixels to treat as a mobile resolution.', 'livemesh-bb-addons'),
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

                'heading_section' => array(
                    'title' => __('Gallery Heading', 'livemesh-bb-addons'),
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
                        'heading_text_transform' => array(
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

                'filter_section' => array(
                    'title' => __('Gallery Filters', 'livemesh-bb-addons'),
                    'fields' => array(

                        'filter_color' => array(
                            'type' => 'color',
                            'label' => __('Filter Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'filter_hover_color' => array(
                            'type' => 'color',
                            'label' => __('Filter Hover Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'filter_active_border' => array(
                            'type' => 'color',
                            'label' => __('Active Filter Border Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'filter_font' => array(
                            'type' => 'font',
                            'label' => __('Filter Font', 'livemesh-bb-addons'),
                            'default' => array(
                                'family' => 'Default',
                                'weight' => 'default'
                            ),
                        ),
                        'filter_font_size' => array(
                            'type' => 'unit',
                            'label' => __('Filter Font Size', 'livemesh-bb-addons'),
                            'responsive' => true,
                        ),
                        'filter_line_height' => array(
                            'type' => 'unit',
                            'label' => __('Filter Line height', 'livemesh-bb-addons'),
                            'responsive' => true,
                        ),
                        'filter_text_transform' => array(
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
                        'filter_font_style' => array(
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

                'carousel_item_thumbnail_section' => array(
                    'title' => __('Gallery Thumbnail', 'livemesh-bb-addons'),
                    'fields' => array(

                        'thumbnail_hover_brightness' => array(
                            'type' => 'labb-number',
                            'label' => __('Thumbnail Hover Brightness (%)', 'livemesh-bb-addons'),
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
                        'tags_hover_color' => array(
                            'type' => 'color',
                            'label' => __('Item Tags Hover Color', 'livemesh-bb-addons'),
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

                'pagination_styling_section' => array(
                    'title' => __('Pagination', 'livemesh-bb-addons'),
                    'fields' => array(

                        'pagination_border_color' => array(
                            'type' => 'color',
                            'label' => __('Border Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'pagination_hover_bg_color' => array(
                            'type' => 'color',
                            'label' => __('Hover Background Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'pagination_nav_icon_color' => array(
                            'type' => 'color',
                            'label' => __('Nav Icon Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'pagination_hover_nav_icon_color' => array(
                            'type' => 'color',
                            'label' => __('Hover Nav Icon Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'pagination_disabled_nav_icon_color' => array(
                            'type' => 'color',
                            'label' => __('Disabled Nav Icon Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                    )
                ),

                'pagination_text_section' => array(
                    'title' => __('Pagination Navigation Text', 'livemesh-bb-addons'),
                    'fields' => array(

                        'pagination_text_color' => array(
                            'type' => 'color',
                            'label' => __('Navigation Text Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'pagination_hover_text_color' => array(
                            'type' => 'color',
                            'label' => __('Navigation Hover Text Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'pagination_text_font' => array(
                            'type' => 'font',
                            'label' => __('Navigation Text Font', 'livemesh-bb-addons'),
                            'default' => array(
                                'family' => 'Default',
                                'weight' => 'default'
                            ),
                        ),
                        'pagination_text_font_size' => array(
                            'type' => 'unit',
                            'label' => __('Navigation Text Font Size', 'livemesh-bb-addons'),
                            'responsive' => true,
                        ),
                        'pagination_text_line_height' => array(
                            'type' => 'unit',
                            'label' => __('Navigation Text Line height', 'livemesh-bb-addons'),
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
                                    'fields' => array('video_link', 'display_video_inline'),
                                ),
                                'vimeo' => array(
                                    'fields' => array('video_link', 'display_video_inline'),
                                ),
                                'html5video' => array(
                                    'fields' => array('mp4_video', 'webm_video', 'display_video_inline'),
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
                        'display_video_inline' => array(
                            'type' => 'labb-toggle-button',
                            'label' => __('Display video inline?', 'livemesh-bb-addons'),
                            'default' => 'no'
                        ),

                    )
                )
            )
        ),
    )
));