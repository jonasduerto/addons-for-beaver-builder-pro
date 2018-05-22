<?php

class LABB_Block_Header_6 extends LABB_Block_Header {

    function get_block_taxonomy_filter() {

        $output = '';

        $terms = $this->get_block_filter_terms();

        if (empty($terms) || is_wp_error($terms))
            return '';

        $output .= '<div class="labb-taxonomy-filter">';

        $output .= '<div class="labb-filter-item segment-0 labb-active"><a data-term-id="" data-taxonomy="" href="#">' . esc_html__('All', 'labb-bb-addons') . '</a></div>';

        $segment_count = 1;
        foreach ($terms as $term) {

            $output .= '<div class="labb-filter-item segment-' . intval($segment_count) . '"><a href="#" data-term-id="' . $term->term_id . '" data-taxonomy="' . $term->taxonomy . '" title="' . esc_html__('View all items filed under ', 'labb-bb-addons') . esc_attr($term->name) . '">' . esc_html($term->name) . '</a></div>';

            $segment_count++;
        }

        $output .= '</div>';

        return $output;

    }

    function get_block_header_class() {

        return 'labb-block-header-expanded labb-block-header-6';

    }
}