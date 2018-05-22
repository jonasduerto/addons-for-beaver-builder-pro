<?php

/*
Widget Name: Livemesh Posts Block
Description: Display your blog posts or custom post types in a filterable block list layout.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBPostsBlockModule extends FLBuilderModule {

    static public $block_counter = 0;

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Posts Block', 'livemesh-bb-addons'),
            'description' => __('Display your blog posts or custom post types in a filterable block list layout.', 'livemesh-bb-addons'),
            'group' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-posts-block/',
            'url' => LABB_ADDONS_URL . 'labb-posts-block/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));

        $this->add_js('labb-blocks-scripts');
        $this->add_css('labb-blocks-styles');

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

    function get_theme_color() {

        return labb_get_theme_color();

    }

}


FLBuilder::register_module('LABBPostsBlockModule', array(
        'post_loop_settings' => array(
            'title' => __('Loop Query', 'livemesh-bb-addons'),
            'file' => FL_BUILDER_DIR . 'includes/loop-settings.php',
        ),
        'general' => array(
            'title' => __('Settings', 'livemesh-bb-addons'),
            'sections' => array(
                'general_section' => array(
                    'fields' =>
                        array(

                            'block_class' => array(
                                'type' => 'text',
                                'description' => __('Specify an unique identifier used as a custom CSS class name and lightbox group name/slug for the block element.', 'livemesh-bb-addons'),
                                'label' => __('Block Identifier/Class', 'livemesh-bb-addons'),
                                'default' => ''
                            ),

                            'taxonomy_chosen' => array(
                                'type' => 'select',
                                'label' => __('Choose the taxonomy to display and filter on.', 'livemesh-bb-addons'),
                                'description' => __('Choose the taxonomy information to display for posts and the taxonomy that is used to filter the posts. Takes effect only if no taxonomy filters are specified when building query.', 'livemesh-bb-addons'),
                                'options' => labb_get_taxonomies_map(),
                                'default' => 'category',
                                'connections' => array('custom_field')
                            ),

                            'filterable' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Enable category/taxonomy filters?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

                            'block_type' => array(
                                'type' => 'select',
                                'label' => __('Choose Block Style', 'livemesh-bb-addons'),
                                'default' => 'block_1',
                                'options' => array(
                                    'block_1' => __('Block Style 1', 'livemesh-bb-addons'),
                                    'block_2' => __('Block Style 2', 'livemesh-bb-addons'),
                                    'block_3' => __('Block Style 3', 'livemesh-bb-addons'),
                                    'block_4' => __('Block Style 4', 'livemesh-bb-addons'),
                                    'block_5' => __('Block Style 5', 'livemesh-bb-addons'),
                                    'block_6' => __('Block Style 6', 'livemesh-bb-addons'),
                                    'block_7' => __('Block Style 7', 'livemesh-bb-addons'),
                                    'block_8' => __('Block Style 8', 'livemesh-bb-addons'),
                                    'block_9' => __('Block Style 9', 'livemesh-bb-addons'),
                                    'block_10' => __('Block Style 10', 'livemesh-bb-addons'),
                                    'block_11' => __('Block Style 11', 'livemesh-bb-addons'),
                                    'block_12' => __('Block Style 12', 'livemesh-bb-addons'),
                                    'block_13' => __('Block Style 13', 'livemesh-bb-addons'),
                                ),
                                'toggle' => array(
                                    'block_1' => array(
                                        'fields' => array('per_line1')
                                    ),
                                    'block_2' => array(
                                        'fields' => array('per_line2', 'per_line2_tablet', 'per_line2_mobile'),
                                    ),
                                    'block_3' => array(
                                        'fields' => array('per_line1')
                                    ),
                                    'block_4' => array(
                                        'fields' => array('per_line2', 'per_line2_tablet', 'per_line2_mobile'),
                                    ),
                                    'block_5' => array(
                                        'fields' => array('per_line2')
                                    ),
                                    'block_6' => array(
                                        'fields' => array('per_line2', 'per_line2_tablet', 'per_line2_mobile'),
                                    ),
                                    'block_10' => array(
                                        'fields' => array('per_line2', 'per_line2_tablet', 'per_line2_mobile'),
                                    ),
                                    'block_11' => array(
                                        'fields' => array('per_line1')
                                    ),
                                    'block_12' => array(
                                        'fields' => array('per_line1'),
                                    ),
                                ),
                                'connections' => array('custom_field')
                            ),

                            'per_line1' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns per row', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 3,
                                'default' => 2,
                                'connections' => array('custom_field')
                            ),
                            
                            'per_line2' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns per row', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 6,
                                'default' => 4,
                                'description' => 'Posts per row (max: 6)',
                                'connections' => array('custom_field')
                            ),

                            'per_line2_tablet' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns in Tablet Resolution', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 4,
                                'default' => 2,
                                'description' => 'Posts per row (max: 4)',
                                'connections' => array('custom_field')
                            ),

                            'per_line2_mobile' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns in Mobile Resolution', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 4,
                                'default' => 1,
                                'description' => 'Posts per row (max: 4)',
                                'connections' => array('custom_field')
                            ),

                            'enable_lightbox' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Enable Lightbox?', 'livemesh-bb-addons'),
                                'default' => 'no'
                            ),
                        )
                ),
                'options_section' => array(
                    'title' => __('Block Header', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'heading' => array(
                                'type' => 'text',
                                'label' => __('Heading for the block', 'livemesh-bb-addons'),
                                'connections' => array('string', 'html'),
                            ),

                            'heading_url' => array(
                                'type' => 'link',
                                'label' => __('URL for the heading', 'livemesh-bb-addons'),
                                'connections' => array('url'),
                            ),

                            'header_template' => array(
                                'type' => 'select',
                                'label' => __('Choose Header Style', 'livemesh-bb-addons'),
                                'default' => 'block_header_1',
                                'options' => array(
                                    'block_header_1' => __('Header Style 1', 'livemesh-bb-addons'),
                                    'block_header_2' => __('Header Style 2', 'livemesh-bb-addons'),
                                    'block_header_3' => __('Header Style 3', 'livemesh-bb-addons'),
                                    'block_header_4' => __('Header Style 4', 'livemesh-bb-addons'),
                                    'block_header_5' => __('Header Style 5', 'livemesh-bb-addons'),
                                    'block_header_6' => __('Header Style 6', 'livemesh-bb-addons'),
                                    'block_header_7' => __('Header Style 7', 'livemesh-bb-addons'),
                                ),
                                'connections' => array('custom_field')
                            ),
                        )
                ),
                'pagination_section' => array(
                    'title' => __('Pagination Settings', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(


                            'posts_per_page' => array(
                                'type' => 'labb-number',
                                'label' => __('Number of items to be displayed per page or on each load more invocation.', 'livemesh-bb-addons'),
                                'default' => 6,
                                'connections' => array('custom_field')
                            ),
                            'pagination' => array(
                                'type' => 'select',
                                'label' => __('Pagination', 'livemesh-bb-addons'),
                                'description' => __('Choose pagination type or choose None if no pagination is desired. Make sure you enter the items per page value in the option \'Number of items to be displayed per page and on each load more invocation\' field below to control number of items to display per page.', 'livemesh-bb-addons'),
                                'default' => 'none',
                                'options' => array(
                                    'none' => __('None', 'livemesh-bb-addons'),
                                    'next_prev' => __('Next Prev', 'livemesh-bb-addons'),
                                    'paged' => __('Paged', 'livemesh-bb-addons'),
                                    'load_more' => __('Load More', 'livemesh-bb-addons'),
                                ),
                                'toggle' => array(
                                    'none' => array(
                                        'fields' => array('offset'),
                                    ),

                                    'next_prev' => array(
                                        'sections' => array('pagination_styling_section'),
                                        'fields' => array(),
                                    ),

                                    'paged' => array(
                                        'sections' => array('pagination_styling_section', 'pagination_text_section'),
                                        'fields' => array(),
                                    ),
                                    'load_more' => array(
                                        'fields' => array('show_remaining'),
                                    ),
                                ),
                                'connections' => array('custom_field')
                            ),

                            'show_remaining' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Display count of items yet to be loaded with the load more button?', 'livemesh-bb-addons'),
                                'default' => 'yes',
                            ),

                        )
                ),
            )
        ),

        'post_content' => array(
            'title' => __('Post Content', 'livemesh-bb-addons'),
            'sections' => array(
                'content_section' => array(
                    'title' => __('Post Content Settings', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'image_linkable' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Link the post image to the post/portfolio?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

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

                            'post_link_new_window' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Open post links in new window?', 'livemesh-bb-addons'),
                                'default' => 'no'
                            ),

                            'display_title' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Display post title below the post/portfolio?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

                            'display_summary' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Display post excerpt/summary below the post/portfolio?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

                            'rich_text_excerpt' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Preserve shortcodes/HTML tags in excerpt?', 'livemesh-bb-addons'),
                                'default' => 'no'
                            ),

                            'excerpt_length' => array(
                                'type' => 'labb-number',
                                'description' => __('Provide the excerpt length in number of words.', 'livemesh-bb-addons'),
                                'label' => __('Excerpt Length?', 'livemesh-bb-addons'),
                                'default' => 25,
                                'connections' => array('custom_field')
                            ),

                            'display_excerpt_lightbox' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Display post excerpt/summary in the lightbox?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),
                        )
                ),
                'post_meta_section' => array(
                    'title' => __('Post Meta Settings', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'display_author' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Display post author info below the post item?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

                            'display_post_date' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Display post date info below the post item?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

                            'display_comments' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Display comments number below the post item?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

                            'display_taxonomy' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Display taxonomy info for the post item? Choose the right taxonomy in Block Settings section.', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

                        )
                ),
            )
        ),

        'style' => array(
            'title' => __('Style', 'livemesh-bb-addons'),
            'sections' => array(

                'heading_section' => array(
                    'title' => __('Block Heading', 'livemesh-bb-addons'),
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
                    'title' => __('Block Filters', 'livemesh-bb-addons'),
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

                /* 'block_item_thumbnail_section' => array(
                    'title' => __('Post Thumbnail', 'livemesh-bb-addons'),
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
                ), */

                'entry_taxonomy_section' => array(
                    'title' => __('Entry Taxonomy Term', 'livemesh-bb-addons'),
                    'fields' => array(

                        'entry_terms_color' => array(
                            'type' => 'color',
                            'label' => __('Taxonomy Terms Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'entry_terms_bg_color' => array(
                            'type' => 'color',
                            'label' => __('Taxonomy Terms Background Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'entry_terms_font' => array(
                            'type' => 'font',
                            'label' => __('Taxonomy Terms Font', 'livemesh-bb-addons'),
                            'default' => array(
                                'family' => 'Default',
                                'weight' => 'default'
                            ),
                        ),
                        'entry_terms_font_size' => array(
                            'type' => 'unit',
                            'label' => __('Taxonomy Terms Font Size', 'livemesh-bb-addons'),
                            'responsive' => true,
                        ),
                        'entry_terms_line_height' => array(
                            'type' => 'unit',
                            'label' => __('Taxonomy Terms Line height', 'livemesh-bb-addons'),
                            'responsive' => true,
                        ),
                    )
                ),

                'entry_title_section' => array(
                    'title' => __('Post Entry Title', 'livemesh-bb-addons'),
                    'fields' => array(

                        'entry_title_tag' => array(
                            'type' => 'select',
                            'label' => __('Entry Title HTML Tag', 'livemesh-bb-addons'),
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
                        'entry_title_color' => array(
                            'type' => 'color',
                            'label' => __('Entry Title Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'entry_title_hover_color' => array(
                            'type' => 'color',
                            'label' => __('Entry Title Hover Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'entry_title_font' => array(
                            'type' => 'font',
                            'label' => __('Entry Title Font', 'livemesh-bb-addons'),
                            'default' => array(
                                'family' => 'Default',
                                'weight' => 'default'
                            ),
                        ),
                        'entry_title_font_size' => array(
                            'type' => 'unit',
                            'label' => __('Entry Title Font Size', 'livemesh-bb-addons'),
                            'responsive' => true,
                        ),
                        'entry_title_line_height' => array(
                            'type' => 'unit',
                            'label' => __('Entry Title Line height', 'livemesh-bb-addons'),
                            'responsive' => true,
                        ),
                        'entry_title_text_transform' => array(
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

                'entry_summary_section' => array(
                    'title' => __('Post Entry Summary', 'livemesh-bb-addons'),
                    'fields' => array(

                        'entry_summary_color' => array(
                            'type' => 'color',
                            'label' => __('Entry Summary Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'entry_summary_font' => array(
                            'type' => 'font',
                            'label' => __('Entry Summary Font', 'livemesh-bb-addons'),
                            'default' => array(
                                'family' => 'Default',
                                'weight' => 'default'
                            ),
                        ),
                        'entry_summary_font_size' => array(
                            'type' => 'unit',
                            'label' => __('Entry Summary Font Size', 'livemesh-bb-addons'),
                            'responsive' => true,
                        ),
                        'entry_summary_line_height' => array(
                            'type' => 'unit',
                            'label' => __('Entry Summary Line height', 'livemesh-bb-addons'),
                            'responsive' => true,
                        ),
                    )
                ),

                'entry_meta_section' => array(
                    'title' => __('Post Entry Meta', 'livemesh-bb-addons'),
                    'fields' => array(

                        'entry_meta_color' => array(
                            'type' => 'color',
                            'label' => __('Entry Meta Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'entry_meta_link_color' => array(
                            'type' => 'color',
                            'label' => __('Entry Meta Link Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'entry_meta_link_hover_color' => array(
                            'type' => 'color',
                            'label' => __('Entry Meta Link Hover Color', 'livemesh-bb-addons'),
                            'default' => '',
                            'show_reset' => true,
                        ),
                        'entry_meta_font' => array(
                            'type' => 'font',
                            'label' => __('Entry Meta Font', 'livemesh-bb-addons'),
                            'default' => array(
                                'family' => 'Default',
                                'weight' => 'default'
                            ),
                        ),
                        'entry_meta_font_size' => array(
                            'type' => 'unit',
                            'label' => __('Entry Meta Font Size', 'livemesh-bb-addons'),
                            'responsive' => true,
                        ),
                        'entry_meta_line_height' => array(
                            'type' => 'unit',
                            'label' => __('Entry Meta Line height', 'livemesh-bb-addons'),
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