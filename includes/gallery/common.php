<?php

/**
 * Gallery class.
 *
 */
class LABB_Gallery_Common {

    /**
     * Holds the class object.
     */
    public static $instance;

    /**
     * Primary class constructor.
     *
     */
    public function __construct() {

        add_filter('attachment_fields_to_edit', array($this, 'attachment_field_grid_width'), 10, 2);
        add_filter('attachment_fields_to_save', array($this, 'attachment_field_grid_width_save'), 10, 2);

        // Ajax calls
        add_action('wp_ajax_labb_load_gallery_items', array($this, 'load_gallery_items_callback'));
        add_action('wp_ajax_nopriv_labb_load_gallery_items', array($this, 'load_gallery_items_callback'));

    }

    public function attachment_field_grid_width($form_fields, $post) {
        $form_fields['labb_grid_width'] = array(
            'label' => esc_html__('Masonry Width', 'livemesh-el-addons'),
            'input' => 'html',
            'html' => '
<select name="attachments[' . $post->ID . '][labb_grid_width]" id="attachments-' . $post->ID . '-labb_grid_width">
  <option ' . selected(get_post_meta($post->ID, 'labb_grid_width', true), "labb-default", false) . ' value="labb-default">' . esc_html__('Default', 'livemesh-el-addons') . '</option>
  <option ' . selected(get_post_meta($post->ID, 'labb_grid_width', true), "labb-wide", false) . ' value="labb-wide">' . esc_html__('Wide', 'livemesh-el-addons') . '</option>
</select>',
            'value' => get_post_meta($post->ID, 'labb_grid_width', true),
            'helps' => esc_html__('Width of the image in masonry gallery grid', 'livemesh-el-addons')
        );

        return $form_fields;
    }

    public function attachment_field_grid_width_save($post, $attachment) {
        if (isset($attachment['labb_grid_width']))
            update_post_meta($post['ID'], 'labb_grid_width', $attachment['labb_grid_width']);

        return $post;
    }

    function load_gallery_items_callback() {
        $items = $this->parse_items($_POST['items']);
        $settings = $this->parse_gallery_settings($_POST['settings']);
        $paged = intval($_POST['paged']);

        $this->display_gallery($items, $settings, $paged);

        wp_die();

    }

    function parse_items($items) {

        $item_coll = array();

        /* Convert to object if array is handed to us - during pagination */
        foreach ($items as $item) {
            // Remove encoded quotes or other characters
            $item['item_name'] = stripslashes($item['item_name']);

            $item['item_description'] = stripslashes($item['item_description']);

            $item['display_video_inline'] = isset($item['display_video_inline']) ? filter_var($item['display_video_inline'], FILTER_VALIDATE_BOOLEAN) : false;

            $item_coll[] = (object)$item;
        }

        return $item_coll;
    }

    function parse_gallery_settings($settings) {

        $s = $settings;

        $s['gallery_class'] = filter_var($s['gallery_class'], FILTER_DEFAULT);

        $s['filterable'] = filter_var($s['filterable'], FILTER_VALIDATE_BOOLEAN);

        $s['per_line'] = filter_var($s['per_line'], FILTER_VALIDATE_INT);

        $s['per_line_tablet'] = filter_var($s['per_line_tablet'], FILTER_VALIDATE_INT);

        $s['per_line_mobile'] = filter_var($s['per_line_mobile'], FILTER_VALIDATE_INT);

        $s['items_per_page'] = filter_var($s['items_per_page'], FILTER_VALIDATE_INT);

        $s['enable_lightbox'] = filter_var($s['enable_lightbox'], FILTER_VALIDATE_BOOLEAN);

        $s['display_item_tags'] = filter_var($s['display_item_tags'], FILTER_VALIDATE_BOOLEAN);

        $s['display_item_title'] = filter_var($s['display_item_title'], FILTER_VALIDATE_BOOLEAN);

        $s = (object)$s; // convert to object since we deal with objects in our gallery methods

        return $s;
    }

    function display_gallery($items, $settings, $paged = 1) {

        $gallery_video = LABB_Gallery_Video::get_instance();

        $items_per_page = intval($settings->items_per_page); ?>

        <?php
        // If pagination option is chosen, filter the items for the current page
        if ($settings->pagination !== 'none')
            $items = $this->get_items_to_display($items, $paged, $items_per_page);
        ?>

        <?php foreach ($items as $item): ?>

            <?php if (empty($item))
                continue; ?>

            <?php

            $item_type = $item->item_type;

            // No need to populate anything if no image is provided for the image
            if ($item_type == 'image' && empty($item->item_image))
                continue;

            $style = '';
            if (!empty($item->tags)) {
                $terms = array_map('trim', explode(',', $item->tags));

                foreach ($terms as $term) {
                    // Get rid of spaces before adding the term
                    $style .= ' term-' . preg_replace('/\s+/', '-', $term);
                }
            }
            ?>

            <?php

            $item_class = 'labb-' . $item_type . '-type';

            $custom_class = get_post_meta($item->item_image, 'labb_grid_width', true);

            if ($custom_class !== '')
                $item_class .= ' ' . $custom_class;

            ?>

        <div class="labb-grid-item labb-gallery-item <?php echo $style; ?> <?php echo $item_class; ?>">

            <?php if ($gallery_video->is_inline_video($item, $settings)): ?>

                <?php $gallery_video->display_inline_video($item, $settings); ?>

            <?php else: ?>

                <div class="labb-project-image">

                    <?php

                    $size = isset($settings->image_size) ? $settings->image_size : 'large';

                    $photo_src = wp_get_attachment_image_src($item->item_image, $size);

                    $photo_data = FLBuilderPhoto::get_attachment_data($item->item_image);

                    // set params
                    $photo_settings = array(
                        'align' => 'center',
                        'link_type' => '',
                        'crop' => $settings->crop,
                        'photo' => $photo_data,
                        'photo_src' => $photo_src[0],
                        'photo_source' => 'library',
                    );

                    // Display caption of the photo as item name if no name is specified by the user - useful in bulk upload case
                    if (empty($item->item_name))
                        $item->item_name = $photo_data->caption;

                    // Display description of the photo as item description if no description is specified by the user - useful in bulk upload case
                    if (empty($item->item_description))
                        $item->item_description = $photo_data->description;

                    ?>

                    <?php if ($gallery_video->is_gallery_video($item, $settings)): ?>

                        <?php if (isset($photo_data->url)): ?>

                            <?php FLBuilder::render_module_html('photo', $photo_settings); ?>

                        <?php elseif ($item_type == 'youtube' || $item_type == 'vimeo') : ?>

                            <?php $thumbnail_url = $gallery_video->get_video_thumbnail_url($item->video_link, $settings); ?>

                            <?php if (!empty($thumbnail_url)): ?>

                                <?php echo sprintf('<img src="%s" title="%s" alt="%s" class="labb-image"/>', esc_url($thumbnail_url), esc_html($item->item_name), esc_html($item->item_name)); ?>

                            <?php endif; ?>

                        <?php endif; ?>

                    <?php else: // item is an image and not a video ?>

                        <?php

                        if (!empty($item->item_link)) {

                            $photo_settings['link_type'] = 'url';

                            $photo_settings['link_url'] = $item->item_link;

                            $photo_settings['link_target'] = $settings->link_target;
                        }

                        ?>

                        <?php FLBuilder::render_module_html('photo', $photo_settings); ?>

                    <?php endif; ?>

                    <div class="labb-image-info">

                        <div class="labb-entry-info">

                            <?php if ($settings->display_item_title == 'yes'): ?>

                                <<?php echo $settings->title_tag; ?> class="labb-entry-title">

                                    <?php if ($item_type == 'image' && !empty($item->item_link)): ?>

                                        <a href="<?php echo esc_url($item->item_link); ?>"
                                           title="<?php echo esc_html($item->item_name); ?>"
                                           target="<?php echo $settings->link_target; ?>"><?php echo esc_html($item->item_name); ?></a>

                                    <?php else: ?>

                                        <?php echo esc_html($item->item_name); ?>

                                    <?php endif; ?>

                                </<?php echo $settings->title_tag; ?>>

                            <?php endif; ?>

                            <?php if ($gallery_video->is_gallery_video($item, $settings)): ?>

                                <?php $gallery_video->display_video_lightbox_link($item, $settings); ?>

                            <?php endif; ?>

                            <?php if ($settings->display_item_tags == 'yes'): ?>

                                <span class="labb-terms"><?php echo esc_html($item->tags); ?></span>

                            <?php endif; ?>

                        </div><!-- .labb-entry-info -->

                        <?php if ($item_type == 'image' && ($settings->enable_lightbox == 'yes')) : ?>

                            <?php $this->display_image_lightbox_link($item, $settings); ?>

                        <?php endif; ?>

                    </div><!-- .labb-image-info -->

                </div>

            <?php endif; ?>

            </div>

            <?php

        endforeach;

    }

    function display_image_lightbox_link($item, $settings) {

        $photo_data = FLBuilderPhoto::get_attachment_data($item->item_image);

        ?>
        <?php if ($photo_data) : ?>

            <?php $image_src = $photo_data->url; ?>

            <?php $anchor_type = (empty($item->item_link) ? 'labb-click-anywhere' : 'labb-click-icon'); ?>

            <a class="labb-lightbox-item <?php echo $anchor_type; ?>"
               data-fancybox="<?php echo $settings->gallery_class; ?>"
               href="<?php echo $image_src; ?>"
               title="<?php echo esc_html($item->item_name); ?>"
               data-description="<?php echo wp_kses_post($item->item_description); ?>"><i
                        class="labb-icon-full-screen"></i></a>

        <?php endif; ?>

        <?php
    }

    function get_gallery_terms($items) {

        $tags = $terms = array();

        foreach ($items as $item) {
            if (!empty($item))
                $tags = array_merge($tags, explode(',', $item->tags));
        }

        // trim whitespaces before applying array_unique
        $tags = array_map('trim', $tags);

        $terms = array_values(array_unique($tags));

        return $terms;

    }

    function get_items_to_display($items, $paged, $items_per_page) {

        $offset = $items_per_page * ($paged - 1);

        $items = array_slice($items, $offset, $items_per_page);

        return $items;
    }

    function paginate_gallery($items, $settings) {

        $pagination_type = $settings->pagination;

        // no pagination required if option is not chosen by user or if all posts are already displayed
        if ($pagination_type == 'none' || count($items) <= $settings->items_per_page)
            return;

        $max_num_pages = ceil(count($items) / $settings->items_per_page);

        $output = '<div class="labb-pagination">';

        if ($pagination_type == 'load_more') {
            $output .= '<a href="#" class="labb-load-more labb-button">';
            $output .= __('Load More', 'livemesh-bb-addons');
            if ($settings->show_remaining == 'yes')
                $output .= ' - ' . '<span>' . (count($items) - $settings->items_per_page) . '</span>';
            $output .= '</a>';
        }
        else {
            $page_links = array();

            for ($n = 1; $n <= $max_num_pages; $n++) :
                $page_links[] = '<a class="labb-page-nav' . ($n == 1 ? ' labb-current-page' : '') . '" href="#" data-page="' . $n . '">' . number_format_i18n($n) . '</a>';
            endfor;

            $r = join("\n", $page_links);

            if (!empty($page_links)) {
                $prev_link = '<a class="labb-page-nav labb-disabled" href="#" data-page="prev"><i class="labb-icon-arrow-left3"></i></a>';
                $next_link = '<a class="labb-page-nav" href="#" data-page="next"><i class="labb-icon-arrow-right3"></i></a>';

                $output .= $prev_link . "\n" . $r . "\n" . $next_link;
            }
        }

        $output .= '<span class="labb-loading"></span>';

        $output .= '</div>';

        return $output;

    }

    /** Isotope filtering support for Gallery * */

    function get_gallery_terms_filter($terms) {

        $output = '';

        if (!empty($terms)) {

            $output .= '<div class="labb-taxonomy-filter">';

            $output .= '<div class="labb-filter-item segment-0 labb-active"><a data-value="*" href="#">' . esc_html__('All', 'livemesh-bb-addons') . '</a></div>';

            $segment_count = 1;
            foreach ($terms as $term) {

                $output .= '<div class="labb-filter-item segment-' . intval($segment_count) . '"><a href="#" data-value=".term-' . preg_replace('/\s+/', '-', $term) . '" title="' . esc_html__('View all items filed under ', 'livemesh-bb-addons') . esc_attr($term) . '">' . esc_html($term) . '</a></div>';

                $segment_count++;
            }

            $output .= '</div>';

        }

        return $output;
    }

    /**
     * Returns the singleton instance of the class.
     *
     */
    public static function get_instance() {

        if (!isset(self::$instance) && !(self::$instance instanceof LABB_Gallery_Common)) {
            self::$instance = new LABB_Gallery_Common();
        }

        return self::$instance;

    }

}

// Load the metabox class.
$labb_gallery_common = LABB_Gallery_Common::get_instance();


