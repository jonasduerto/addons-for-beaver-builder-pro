<?php

class LABB_Module {

    protected $post;

    protected $post_ID;

    protected $settings;

    function __construct($post, $settings) {

        $this->post = $post;

        $this->post_ID = $post->ID;

        $this->settings = $settings;
    }

    function get_module_classes() {

        return 'labb-module';

    }

    /**
     * Full attachment image url.
     *
     * Gets a post ID and returns the url for the 'full' size of the attachment
     * set as featured image.
     *
     */
    protected function _get_uncropped_url($id) {

        $thumb_id = get_post_thumbnail_id($id);

        $size = isset($this->settings->image_size) ? $this->settings->image_size : 'large';

        $img = wp_get_attachment_image_src($thumb_id, $size);

        return $img[0];
    }


    /**
     * Get the featured image data.
     *
     * Gets a post ID and returns an array containing the featured image data.
     *
     */
    protected function _get_img_data($id) {

        $thumb_id = get_post_thumbnail_id($id);

        return FLBuilderPhoto::get_attachment_data($thumb_id);

    }


    /**
     * Render thumbnail image for mobile.
     *
     * Get's the post ID and renders the html markup for the featured image
     * in the desired cropped size.
     *
     */
    protected function render_img($id = null) {

        // get image source and data
        $src = $this->_get_uncropped_url($id);

        $photo_data = $this->_get_img_data($id);

        // set params
        $photo_settings = array(
            'align' => 'center',
            'link_type' => '',
            'crop' => $this->settings->crop,
            'photo' => $photo_data,
            'photo_src' => $src,
            'photo_source' => 'library',
            'attributes' => array(
                'data-no-lazy' => 1,
            ),
        );

        if ($id && $this->settings->image_linkable) {

            $photo_settings['link_type'] = 'url';

            // the link id is provided, set link_url param
            $photo_settings['link_url'] = get_the_permalink($id);

            if ($this->settings->post_link_new_window)
                $photo_settings['link_target'] = '_blank';
            else
                $photo_settings['link_target'] = '_self';
        }

        // render image
        FLBuilder::render_module_html('photo', $photo_settings);

    }

    function get_img($id = null) {

        ob_start();

        // render image
        $this->render_img($id);

        return ob_get_clean();

    }

    function get_thumbnail($size = 'custom') {

        $output = '';

        if ($thumbnail_exists = has_post_thumbnail($this->post_ID)):

            $output .= '<div class="labb-module-thumb">';

            $output .= $this->get_media($size);

            $output .= $this->get_lightbox();

            $output .= '</div><!-- .labb-module-thumb -->';

        endif;

        return $output;
    }

    function get_media($size = 'custom') {

        $output = '';

        if ($size !== 'custom') {

            $thumbnail_html = get_the_post_thumbnail($this->post_ID, $size);

            if ($this->settings->image_linkable):

                $target = $this->settings->post_link_new_window ? ' target="_blank"' : '';

                $output .= '<a class="labb-post-link" href="' . get_the_permalink($this->post_ID) . '"' . $target . ' itemprop="url">' . $thumbnail_html . '</a>';

            else:

                $output .= $thumbnail_html;

            endif;

        }
        else {

            $output = $this->get_img($this->post_ID);
        }

        return $output;
    }

    function get_lightbox() {

        $output = '';

        if ($this->settings->enable_lightbox) :

            $featured_image_id = get_post_thumbnail_id($this->post_ID);

            $featured_image_data = wp_get_attachment_image_src($featured_image_id, 'full');

            if ($featured_image_data) {

                $featured_image_src = $featured_image_data[0];

                $output .= '<a class="labb-lightbox-item" data-fancybox="' . esc_attr($this->settings->block_class) . '" data-post-link="' . esc_url(get_the_permalink($this->post_ID)) . '" data-post-excerpt="' . esc_html($this->get_excerpt_for_lightbox()) . '" href="' . $featured_image_src . '" title="' . get_the_title($this->post_ID) . '"><i class="labb-icon-full-screen"></i></a>';

            }

        endif;

        return $output;
    }

    function get_media_title() {

        $output = '';

        if ($this->settings->display_title_on_thumbnail) :

            $target = $this->settings->post_link_new_window ? ' target="_blank"' : '';

            $output = '<' . $this->settings->thumbnail_info_title_tag . ' class="labb-post-title">';

            $output .= '<a href="' . get_permalink($this->post_ID) . '" title="' . get_the_title($this->post_ID) . '" rel="bookmark"' . $target . '>' . get_the_title($this->post_ID) . '</a>';

            $output .= '</' . $this->settings->thumbnail_info_title_tag . '>';

        endif;

        return $output;

    }

    function get_media_taxonomy() {

        $output = '';

        if ($this->settings->display_taxonomy_on_thumbnail) :

            if (empty($taxonomies))
                $taxonomies = $this->settings->taxonomies;

            foreach ($taxonomies as $taxonomy) {

                $output .= $this->get_taxonomy_info($taxonomy);

            }

        endif;

        return $output;

    }

    function get_media_overlay() {

        $output = '<div class="labb-module-image-overlay"></div>';

        return $output;

    }

    function get_title() {

        $output = '';

        if ($this->settings->display_title) :

            $target = $this->settings->post_link_new_window ? ' target="_blank"' : '';

            $output = '<' . $this->settings->entry_title_tag . ' class="entry-title">';

            $output .= '<a href="' . get_permalink($this->post_ID) . '" title="' . get_the_title($this->post_ID) . '" rel="bookmark"' . $target . '>' . get_the_title($this->post_ID) . '</a>';

            $output .= '</' . $this->settings->entry_title_tag . '>';

        endif;

        return $output;

    }

    function get_excerpt() {

        $output = '';

        if ($this->settings->display_summary) :

            $excerpt_count = $this->settings->excerpt_length;

            $output = '<div class="entry-summary">';

            if (empty($this->post->post_excerpt))
                $excerpt = $this->post->post_content;
            else
                $excerpt = $this->post->post_excerpt;

            if ($this->settings->rich_text_excerpt)
                $output .= do_shortcode(force_balance_tags(html_entity_decode(wp_trim_words(htmlentities($excerpt), $excerpt_count, '…'))));
            else
                $output .= wp_trim_words(wp_strip_all_tags(strip_shortcodes($excerpt)), $excerpt_count, '…');

            $output .= '</div><!-- .entry-summary -->';

        endif;

        return $output;

    }

    function get_excerpt_for_lightbox() {

        $output = '';

        if ($this->settings->display_excerpt_lightbox) :

            // Trim the excerpt only if you are displaying content since lightbox has lots of room for displaying excerpt
            if (empty($this->post->post_excerpt)) {

                $excerpt_count = $this->settings->excerpt_length;

                $excerpt = $this->post->post_content;

                $excerpt = wp_trim_words(wp_strip_all_tags(strip_shortcodes($excerpt)), $excerpt_count, '…');
            }
            else {
                $excerpt = $this->post->post_excerpt;
            }

            $output .= do_shortcode($excerpt);

        endif;

        return $output;

    }

    function get_read_more_link() {

        $output = '';

        if ($this->settings->display_read_more) {

            $output .= '<div class="labb-read-more">';

            $output .= '<a href="' . get_the_permalink($this->post_ID) . '">' . esc_html__('Read more', 'labb-bb-addons') . '</a>';

            $output .= '</div>';

        }

        return $output;

    }

    function get_taxonomy_info($taxonomy) {

        $output = '';

        $terms = get_the_terms($this->post_ID, $taxonomy);

        if (!empty($terms) && !is_wp_error($terms)) {

            $output .= '<span class="labb-terms">';

            $term_count = 0;

            foreach ($terms as $term) {

                if ($term_count != 0)
                    $output .= ', ';

                $output .= '<a href="' . get_term_link($term->slug, $taxonomy) . '">' . $term->name . '</a>';

                $term_count = $term_count + 1;
            }
            $output .= '</span>';
        }
        return $output;
    }

    function get_taxonomies_info($taxonomies = null) {

        $output = '';

        if ($this->settings->display_taxonomy) :

            if (empty($taxonomies))
                $taxonomies = $this->settings->taxonomies;

            foreach ($taxonomies as $taxonomy) {

                $output .= $this->get_taxonomy_info($taxonomy);

            }

        endif;

        return $output;
    }

    function get_author() {

        $output = '';

        if ($this->settings->display_author) :

            $output .= '<span class="author vcard">' . esc_html__('By ', 'livemesh-bb-addons') . '<a class="url fn n" href="' . get_author_posts_url($this->post->post_author) . '" title="' . esc_attr(get_the_author_meta('display_name', $this->post->post_author)) . '">' . esc_html(get_the_author_meta('display_name', $this->post->post_author)) . '</a></span>';

        endif;

        return $output;
    }

    function get_date($format = null) {

        $output = '';

        if ($this->settings->display_post_date) :

            if (empty($format))
                $format = get_option('date_format');

            $output .= '<span class="published"><abbr title="' . get_the_time(esc_html__('l, F, Y, g:i a', 'livemesh-bb-addons'), $this->post_ID) . '">' . get_the_time($format, $this->post_ID) . '</abbr></span>';

        endif;

        return $output;
    }

    function get_comments() {

        $output = '';

        if ($this->settings->display_comments) :

            $output .= $this->entry_comments_link($this->post_ID);

        endif;

        return $output;

    }

    function entry_comments_link($id, $args = array()) {

        $comments_link = '';
        $num_of_comments = doubleval(get_comments_number($id));

        $defaults = array('zero' => __('No Comments', 'livemesh-bb-addons'), 'one' => __('%1$s Comment', 'livemesh-bb-addons'), 'more' => __('%1$s Comments', 'livemesh-bb-addons'), 'css_class' => 'labb-comments', 'none' => '', 'before' => '', 'after' => '');

        /* Merge the input arguments and the defaults. */
        $args = wp_parse_args($args, $defaults);

        $comments_link .= '<span class="' . esc_attr($args['css_class']) . '">';

        if (0 == $num_of_comments && !comments_open($id) && !pings_open($id)) {
            if ($args['none'])
                $comments_link .= sprintf($args['none'], number_format_i18n($num_of_comments));
        }
        elseif (0 == $num_of_comments)
            $comments_link .= '<a href="' . get_permalink($id) . '#respond" title="' . sprintf(esc_attr__('Comment on %1$s', 'livemesh-bb-addons'), the_title_attribute(array('echo' => false, 'post' => $id))) . '">' . sprintf($args['zero'], number_format_i18n($num_of_comments)) . '</a>';
        elseif (1 == $num_of_comments)
            $comments_link .= '<a href="' . get_comments_link($id) . '" title="' . sprintf(esc_attr__('Comment on %1$s', 'livemesh-bb-addons'), the_title_attribute(array('echo' => false, 'post' => $id))) . '">' . sprintf($args['one'], number_format_i18n($num_of_comments)) . '</a>';
        elseif (1 < $num_of_comments)
            $comments_link .= '<a href="' . get_comments_link($id) . '" title="' . sprintf(esc_attr__('Comment on %1$s', 'livemesh-bb-addons'), the_title_attribute(array('echo' => false, 'post' => $id))) . '">' . sprintf($args['more'], number_format_i18n($num_of_comments)) . '</a>';

        $comments_link .= '</span>';

        $comments_link = $args['before'] . $comments_link . $args['after'];

        return $comments_link;
    }

    function entry_comments_number($id, $args = array()) {
        $comments_text = '';
        $number = get_comments_number($id);
        $defaults = array('zero' => __('No Comments', 'livemesh-bb-addons'), 'one' => __('%1$s Comment', 'livemesh-bb-addons'), 'more' => __('%1$s Comments', 'livemesh-bb-addons'), 'css_class' => 'labb-comments', 'none' => '', 'before' => '', 'after' => '');

        /* Merge the input arguments and the defaults. */
        $args = wp_parse_args($args, $defaults);

        $comments_text .= '<span class="' . esc_attr($args['css_class']) . '">';

        if (0 == $number && !comments_open($id) && !pings_open($id)) {
            if ($args['none'])
                $comments_text .= sprintf($args['none'], number_format_i18n($number));
        }
        elseif ($number == 0)
            $comments_text .= sprintf($args['zero'], number_format_i18n($number));
        elseif ($number == 1)
            $comments_text .= sprintf($args['one'], number_format_i18n($number));
        elseif ($number > 1)
            $comments_text .= sprintf($args['more'], number_format_i18n($number));

        $comments_text .= '</span>';

        if ($comments_text)
            $comments_text = $args['before'] . $comments_text . $args['after'];

        return $comments_text;
    }

}